#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class RankingsOutput(Foundation):
		
	def __init__(self, collectionName):
	
		client = MongoClient()
		db = client.TheOrangeAlliance
		collection = eval("db."+collectionName)

		foundation = Foundation(collectionName)
		teamList = foundation.UniqueTeamList()
		matchesThatTeamPlayedAndAlliance = foundation.WhichMatchesDidThatTeamPlayAndWhatAllaince(teamList, collectionName)
		
		self.cursor = collection.find({'MetaData.MetaData' : 'ResultsInput'})
		
		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "RankingsData"
		finalDictionary["MetaData"]["TimeStamp"] = "anytime"
		finalDictionary["MetaData"]["DatePlace"] = collectionName
		finalDictionary["MetaData"]["InputID"] = "8"
		finalDictionary["Rankings"] = {}
		
		for team in teamList:
			finalDictionary["Rankings"][str(team)] = {}
			finalDictionary["Rankings"][str(team)]["TeamNumber"] = team
			tempBlue = matchesThatTeamPlayedAndAlliance[team]["Blue"]
			tempRed = matchesThatTeamPlayedAndAlliance[team]["Red"]
			win = 0
			loss = 0
			tie = 0
			RP = 0
			for matchNumber in tempRed:
				self.cursor = collection.find({'MetaData.MetaData' : 'ResultsInput'})
				for document in self.cursor:
					if document["ResultsInformation"]['MatchNumber'] == matchNumber:
						print(team)
						print("hi")
						if document["ResultsInformation"]['Winner'] == 'Red':
							RP += document['Score']['Total']['Blue']
							win += 1
						elif document["ResultsInformation"]['Winner'] == 'Blue':
							RP += document['Score']['Total']['Red']
							loss += 1
						elif document["ResultsInformation"]['Winner'] == 'Tie':
							RP += document['Score']['Total']['Red']
							tie += 1
						else:
							win += 100000000
			for matchNumber in tempBlue:
				self.cursor = collection.find({'MetaData.MetaData' : 'ResultsInput'})
				for document in self.cursor:
					if document["ResultsInformation"]['MatchNumber'] == matchNumber:
						if document["ResultsInformation"]['Winner'] == 'Blue':
							RP += document['Score']['Total']['Red']
							win += 1
						elif document["ResultsInformation"]['Winner'] == 'Red':
							RP += document['Score']['Total']['Blue']
							loss += 1
						elif document["ResultsInformation"]['Winner'] == 'Tie':
							RP += document['Score']['Total']['Blue']
							tie += 1
						else:
							win += 100000000
			finalDictionary["Rankings"][str(team)]["RecordWin"] = win
			finalDictionary["Rankings"][str(team)]["RecordTie"] = tie
			finalDictionary["Rankings"][str(team)]["RecordLose"] = loss
			finalDictionary["Rankings"][str(team)]["QP"] = win * 2
			finalDictionary["Rankings"][str(team)]["RP"] = RP
			
		tempArray = {}
		count = 0
		for team in teamList:
			tempArray[count] = (finalDictionary["Rankings"][str(team)]["QP"] * 10000) + finalDictionary["Rankings"][str(team)]["RP"]
			count += 1
		print(tempArray)
		for team in teamList:
			teamRank = 1
			for compareTeam in tempArray:
				if team < compareTeam:
					teamRank += 1
			finalDictionary["Rankings"][str(team)]["Rank"] = teamRank
			
		pprint(finalDictionary)

		#collection.delete_many({"MetaData.MetaData": "RankingsData"})
		#collection.insert_one(finalDictionary)
				
if __name__ == '__main__': #prevents unnecessarily running if imported in another script
	test = RankingsOutput("Y201702255")