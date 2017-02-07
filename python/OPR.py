#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
import numpy

class Opr(Foundation):

	def getOprArray(self):
		return self.oprArrayPretty

	def formatNumber(self, number):
		return format(number, '.2f').rstrip('0').rstrip('.')

	def WhichMatchesDidThatTeamPlayAndWhatAllaince(self, teamList):
		teamList = teamList
		MatchesThatTeamPlayedAndAlliance = {}
		for document in self.cursor:
			for team in teamList:
				matchListRed = []
				matchListBlue = []
				for matchNumber in range(1, len(document['Match'].values())):
					for alliance, teamOnThatAlliance in document['Match']['Match' + str(matchNumber)].items():
						if alliance == 'Red1' or alliance == 'Red2':
							if teamOnThatAlliance == team:
								matchListRed.append(matchNumber)
						if alliance == 'Blue1' or alliance == 'Blue2':
							if teamOnThatAlliance == team:
								matchListBlue.append(matchNumber)
				MatchesThatTeamPlayedAndAlliance.update({team : {'Red' : matchListRed , 'Blue' : matchListBlue}})
		return MatchesThatTeamPlayedAndAlliance

	def __init__(self, collectionName):
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = eval("db."+collectionName)
		self.cursor = collection.find({'MetaData.MetaData': 'ScheduleInput', 'MetaData.InputID': "rainbow"})
		teamNumbers = self.UniqueTeamList()
		numTeams = len(teamNumbers)
		whoPlaysWhoArray = [[0 for x in range(numTeams)] for y in range(numTeams)]
		self.cursor = collection.find({'MetaData.MetaData': 'ScheduleInput', 'MetaData.InputID': "rainbow"})
		document = self.cursor[0]
		for match in document["Match"].values():
			b1 = teamNumbers.index(match["Blue1"])
			b2 = teamNumbers.index(match["Blue2"])
			r1 = teamNumbers.index(match["Red1"])
			r2 = teamNumbers.index(match["Red2"])
			whoPlaysWhoArray[b1][b2] += 1
			whoPlaysWhoArray[b2][b1] += 1
			whoPlaysWhoArray[b1][b1] += 1
			whoPlaysWhoArray[b2][b2] += 1
			whoPlaysWhoArray[r1][r2] += 1
			whoPlaysWhoArray[r2][r1] += 1
			whoPlaysWhoArray[r1][r1] += 1
			whoPlaysWhoArray[r2][r2] += 1
		whoPlaysWhoMatrix = numpy.asmatrix(numpy.array(whoPlaysWhoArray))
		print whoPlaysWhoMatrix

		print " "
		whoPlaysWhoMatrixInverse = numpy.linalg.inv(whoPlaysWhoMatrix)
		print whoPlaysWhoMatrixInverse

		print " "
		matchesAndAlliances = self.WhichMatchesDidThatTeamPlayAndWhatAllaince(teamNumbers)
		totalRp = [0 for x in range(numTeams)]
		for i in range(numTeams):
			for matchNumber in matchesAndAlliances[teamNumbers[i]]["Blue"]:
				self.cursor = collection.find({'MetaData.MetaData': 'ResultsInput', 'MetaData.InputID': "rainbow", 'MatchNumber': matchNumber})
				if self.cursor.count() > 0:
					totalRp[i] += self.cursor[0]["Score"]["Total"]["Blue"]
					print "Team " + str(teamNumbers[i]) + " got " + str(self.cursor[0]["Score"]["Total"]["Blue"]) + " points on the Blue alliance in match " + str(matchNumber)
			for matchNumber in matchesAndAlliances[teamNumbers[i]]["Red"]:
				self.cursor = collection.find({'MetaData.MetaData': 'ResultsInput', 'MetaData.InputID': "rainbow", 'MatchNumber': matchNumber})
				if self.cursor.count() > 0:
					totalRp[i] += self.cursor[0]["Score"]["Total"]["Red"]
					print "Team " + str(teamNumbers[i]) + " got " + str(self.cursor[0]["Score"]["Total"]["Red"]) + " points on the Red alliance in match " + str(matchNumber)
		totalRpMatrix = numpy.rot90(numpy.asmatrix(numpy.array(totalRp)), 3)
		print totalRpMatrix

		print " "
		oprMatrix = numpy.dot(whoPlaysWhoMatrixInverse, totalRpMatrix)
		print oprMatrix

		oprArray = numpy.asarray(numpy.rot90(oprMatrix))[0]
		self.oprArrayPretty = []
		for num in oprArray:
			self.oprArrayPretty.append(self.formatNumber(num))
		print " "
		print self.oprArrayPretty

		print "END OPR"
		print " "

if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = Opr("Y201702041")