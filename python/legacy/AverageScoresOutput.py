#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class AverageScoresOutput(Foundation):

	def formatNumber(self, number):
		return format(number, '.2f').rstrip('0').rstrip('.')

	def getPercentCondition(self, teamNumber, section, value, condition):
		total = 0;
		conditionCount = 0;
		for document in self.data[teamNumber]:
			total = total+1
			if document["GameInformation"][section][value] == condition:
				conditionCount = conditionCount+1
		return self.formatNumber((conditionCount/float(total))*100) + "%"

	def getAverageNum(self, teamNumber, section, value):
		total = 0;
		num = 0;
		for document in self.data[teamNumber]:
			total = total+1
			num = num + document["GameInformation"][section][value]
		return self.formatNumber(num/float(total))
				
	def __init__(self, collectionName):
		self.data = {}
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = eval("db."+collectionName)
		self.cursor = collection.find({'MetaData.MetaData': 'ScheduleInput', 'MetaData.InputID': "rainbow"})
		teamNumbers = self.UniqueTeamList()
		self.cursor = collection.find({'MetaData.MetaData': 'MatchInput', 'MetaData.InputID': "rainbow"})
		for document in self.cursor:
			if int(document["MatchInformation"]["TeamNumber"]) not in self.data:
				self.data[int(document["MatchInformation"]["TeamNumber"])] = []
			self.data[int(document["MatchInformation"]["TeamNumber"])].append(document)
		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "AverageScoresOutput"
		finalDictionary["MetaData"]["TimeStamp"] = "anytime"
		finalDictionary["MetaData"]["InputID"] = "rainbow"
		finalDictionary["AverageScores"] = [];
		for teamNumber in teamNumbers:
			thisArray = []
			thisArray.append(teamNumber) # 0
			thisArray.append(self.TeamName(teamNumber)) # 1
			if int(teamNumber) not in self.data:
				for i in range(16):
					thisArray.append(None)
				finalDictionary["AverageScores"].append(thisArray)
				continue
			thisArray.append(self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Did Not Park")) # 2
			thisArray.append(self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Partially On Center Vortex")) # 3
			thisArray.append(self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Partially On Corner Vortex")) # 4
			thisArray.append(self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Fully On Center Vortex")) # 5
			thisArray.append(self.getPercentCondition(teamNumber, "AUTO", "RobotParking", "Fully On Corner Vortex")) # 6
			thisArray.append(self.getAverageNum(teamNumber, "AUTO", "ParticlesCenter")) # 7
			thisArray.append(self.getAverageNum(teamNumber, "AUTO", "ParticlesCorner"))  # 8
			thisArray.append(self.getPercentCondition(teamNumber, "AUTO", "CapBall", "Yes")) # 9
			thisArray.append(self.getAverageNum(teamNumber, "AUTO", "ClaimedBeacons")) # 10
			thisArray.append(self.getAverageNum(teamNumber, "DRIVER", "ParticlesCenter")) # 11
			thisArray.append(self.getAverageNum(teamNumber, "DRIVER", "ParticlesCorner")) # 12
			thisArray.append(self.getAverageNum(teamNumber, "END", "AllianceClaimedBeacons")) # 13
			thisArray.append(self.getPercentCondition(teamNumber, "END", "CapBall", "On The Ground")) # 14
			thisArray.append(self.getPercentCondition(teamNumber, "END", "CapBall", "Raised Off The Floor")) # 15
			thisArray.append(self.getPercentCondition(teamNumber, "END", "CapBall", "Raised Above Vortex")) # 16
			thisArray.append(self.getPercentCondition(teamNumber, "END", "CapBall", "Scored In Center Vortex")) # 17
			finalDictionary["AverageScores"].append(thisArray)
		collection.delete_many({'MetaData.MetaData': 'AverageScoresOutput'})
		collection.insert_one(finalDictionary)
		self.cursor = collection.find({'MetaData.MetaData': 'AverageScoresOutput', 'MetaData.InputID' : "rainbow"})
		for document in self.cursor:
			pprint(document)

if __name__ == '__main__': #prevents unnecessarily running if imported in another script				
	test = AverageScoresOutput("Y201702052")