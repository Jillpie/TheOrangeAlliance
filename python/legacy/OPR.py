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
				for matchNumber in range(1, len(document['Match'].values())+1):
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

		print " "
		whoPlaysInWhichMatch = {}
		self.cursor = collection.find({'MetaData.MetaData': 'ScheduleInput', 'MetaData.InputID': "rainbow"})
		matchesAndAlliances = self.WhichMatchesDidThatTeamPlayAndWhatAllaince(teamNumbers)
		totalRp = [0 for x in range(numTeams)]
		for i in range(numTeams):
			for matchNumber in matchesAndAlliances[teamNumbers[i]]["Blue"]:
				self.cursor = collection.find({'MetaData.MetaData': 'ResultsInput', 'MetaData.InputID': "rainbow", 'MatchNumber': matchNumber})
				if self.cursor.count() > 0:
					totalRp[i] += self.cursor[0]["Score"]["Total"]["Blue"]
					if (not matchNumber in whoPlaysInWhichMatch):
						whoPlaysInWhichMatch[matchNumber] = {}
					if (not "Blue1" in whoPlaysInWhichMatch[matchNumber]):
						whoPlaysInWhichMatch[matchNumber]["Blue1"] = i
					else:
						whoPlaysInWhichMatch[matchNumber]["Blue2"] = i
					#print "Team " + str(teamNumbers[i]) + " got " + str(self.cursor[0]["Score"]["Total"]["Blue"]) + " points on the Blue alliance in match " + str(matchNumber)
			for matchNumber in matchesAndAlliances[teamNumbers[i]]["Red"]:
				self.cursor = collection.find({'MetaData.MetaData': 'ResultsInput', 'MetaData.InputID': "rainbow", 'MatchNumber': matchNumber})
				if self.cursor.count() > 0:
					totalRp[i] += self.cursor[0]["Score"]["Total"]["Red"]
					if (not matchNumber in whoPlaysInWhichMatch):
						whoPlaysInWhichMatch[matchNumber] = {}
					if (not "Red1" in whoPlaysInWhichMatch[matchNumber]):
						whoPlaysInWhichMatch[matchNumber]["Red1"] = i
					else:
						whoPlaysInWhichMatch[matchNumber]["Red2"] = i
					#print "Team " + str(teamNumbers[i]) + " got " + str(self.cursor[0]["Score"]["Total"]["Red"]) + " points on the Red alliance in match " + str(matchNumber)
		totalRpMatrix = numpy.rot90(numpy.asmatrix(numpy.array(totalRp)), 3)
		print totalRpMatrix

		print " "
		whoPlaysWhoArray = [[0 for x in range(numTeams)] for y in range(numTeams)]
		for match in whoPlaysInWhichMatch.values():
			b1 = match["Blue1"]
			b2 = match["Blue2"]
			r1 = match["Red1"]
			r2 = match["Red2"]
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

		# print " "
		# for i in range(numTeams):
		# 	if whoPlaysWhoArray[i][i] == 5:
		# 		print "Team " + str(teamNumbers[i]) + " only played 5 matches!"
		# 	if whoPlaysWhoArray[i][i] == 7:
		# 		print "Team " + str(teamNumbers[i]) + " played 7 matches!!!!!!"

		print " "
		if (numpy.linalg.det(whoPlaysWhoMatrix) != 0):
			oprMatrix = numpy.linalg.solve(whoPlaysWhoMatrix, totalRpMatrix)
			print oprMatrix

			oprArray = numpy.asarray(numpy.rot90(oprMatrix))[0]
			self.oprArrayPretty = []
			for num in oprArray:
				self.oprArrayPretty.append(self.formatNumber(num))
			print " "
			print self.oprArrayPretty
			print "FINISHED OPR"
		else:
			self.oprArrayPretty = ['' for x in range(numTeams)]
			print "OPR UNSOLVABLE!!!"

		print " "

if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = Opr("Y201702041")