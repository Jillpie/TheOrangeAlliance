#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class AverageScoresOutput(Foundation):

	def getPercentParking(self, teamNumber, parkingType):
		total = 0;
		parking = 0;
		for document in data[teamNumber]:
			total = total+1
			if document["GameInformation"]["AUTO"]["RobotParking"] == parkingType:
				parking = parking+1
		return (parking/float(total))*100

	def getPercentCapBallAuto(self, teamNumber):
		total = 0;
		capBall = 0;
		for document in data[teamNumber]:
			total = total+1
			if document["GameInformation"]["AUTO"]["CapBall"] == "Yes":
				capBall = capBall+1
		return (capBall/float(total))*100

	def getAverageNum(self, teamNumber, section, value):
		total = 0;
		num = 0;
		for document in data[teamNumber]:
			total = total+1
			num = num + document["GameInformation"][section][value]
		return num/float(total)

	def getPercentCapBallEnd(self, teamNumber, capBallType):
		total = 0;
		capBall = 0;
		for document in data[teamNumber]:
			total = total+1
			if document["GameInformation"]["END"]["CapBall"] == capBallType:
				capBall = capBall+1
		return (capBall/float(total))*100
				
	def __init__(self):
		global data
		global teamNumbers
		data = {}
		teamNumbers = []
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = db.T000000000
		self.cursor = collection.find({'MetaData.MetaData': 'MatchInput'})
		for document in self.cursor:
			if document["MatchInformation"]["TeamNumber"] not in data:
				teamNumbers.append(document["MatchInformation"]["TeamNumber"])
				data[document["MatchInformation"]["TeamNumber"]] = []
			data[document["MatchInformation"]["TeamNumber"]].append(document)
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
			thisArray.append(self.getPercentParking(teamNumber, "Did Not Park")) # 2
			thisArray.append(self.getPercentParking(teamNumber, "Partially On Center Vortex")) # 3
			thisArray.append(self.getPercentParking(teamNumber, "Partially On Corner Vortex")) # 4
			thisArray.append(self.getPercentParking(teamNumber, "Fully On Center Vortex")) # 5 TODO verify string
			thisArray.append(self.getPercentParking(teamNumber, "Fully On Corner Vortex")) # 6 TODO verify string
			thisArray.append(self.getAverageNum(teamNumber, "AUTO", "ParticlesCenter")) # 7
			thisArray.append(self.getAverageNum(teamNumber, "AUTO", "ParticlesCorner"))  # 8
			thisArray.append(self.getPercentCapBallAuto(teamNumber)) # 9
			thisArray.append(self.getAverageNum(teamNumber, "AUTO", "ClaimedBeacons")) # 10
			thisArray.append(self.getAverageNum(teamNumber, "DRIVER", "ParticlesCenter")) # 11
			thisArray.append(self.getAverageNum(teamNumber, "DRIVER", "ParticlesCorner")) # 12
			thisArray.append(self.getAverageNum(teamNumber, "END", "AllianceClaimedBeacons")) # 13
			thisArray.append(self.getPercentCapBallEnd(teamNumber, "On The Ground")) # 14
			thisArray.append(self.getPercentCapBallEnd(teamNumber, "Raised Off The Floor")) # 15
			thisArray.append(self.getPercentCapBallEnd(teamNumber, "Raised Above Center")) # 16 TODO verify string
			thisArray.append(self.getPercentCapBallEnd(teamNumber, "Scored In Center Vortex")) # 17
			finalDictionary["AverageScores"].append(thisArray)
		collection.delete_many({'MetaData.MetaData': 'AverageScoresOutput'})
		collection.insert_one(finalDictionary)
		self.cursor = collection.find({'MetaData.MetaData': 'AverageScoresOutput'})
		for document in self.cursor:
			pprint(document)
				
test = AverageScoresOutput()