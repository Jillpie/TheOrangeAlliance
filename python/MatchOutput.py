#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
from OPR import Opr

class MatchOutput(Foundation):
		
	def matchNumber(self, rows, matchHistoryTable):
		matchNum = 1
		counter = 0
		for i in range(0,rows):
			if counter < 3:
				matchHistoryTable[i][0] = str(matchNum)
				counter = counter + 1
			else:
				matchHistoryTable[i][0] = str(matchNum)
				matchNum = matchNum+ 1
				counter = 0
		return matchHistoryTable
		
	def alliance(self, rows, matchHistoryTable):
		for i in range(0, rows, 4):
			matchHistoryTable[i][1] = "Red"
		for i in range(1, rows, 4):
			matchHistoryTable[i][1] = "Red"
		for i in range(2, rows, 4):
			matchHistoryTable[i][1] = "Blue"
		for i in range(3, rows, 4):
			matchHistoryTable[i][1] = "Blue"
		return matchHistoryTable
	
	def teamNumber(self, rows, matchHistoryTable):
		matchNumber = 1
		for document in self.cursor:
			for i in range(0,rows, 4):
				matchHistoryTable[i][2] =  document["Match"]["Match" + str(matchNumber)]["Red1"]
				matchNumber = matchNumber + 1
			matchNumber = 1
			for i in range(1, rows, 4):
				matchHistoryTable[i][2] =  document["Match"]["Match" + str(matchNumber)]["Red2"]
				matchNumber = matchNumber + 1
			matchNumber = 1
			for i in range(2, rows, 4):
				matchHistoryTable[i][2] =  document["Match"]["Match" + str(matchNumber)]["Blue1"]
				matchNumber = matchNumber + 1
			matchNumber = 1
			for i in range(3, rows, 4):
				matchHistoryTable[i][2] =  document["Match"]["Match" + str(matchNumber)]["Blue2"]
				matchNumber = matchNumber + 1
		return matchHistoryTable

	def teamName(self, rows, matchHistoryTable):
		for i in range(0, rows):
			matchHistoryTable[i][3] = self.TeamName(matchHistoryTable[i][2])
		return matchHistoryTable
		
	def opr(self, rows, matchHistoryTable, oprScore):
		print("test")
		print(oprScore)
		teamNumbers = self.UniqueTeamList()
		for i in range(0, rows):
			matchHistoryTable[i][4] = oprScore[teamNumbers.index(matchHistoryTable[i][2])]
		return matchHistoryTable
		

	def result(self, rows, matchHistoryTable):
		for document in self.cursor:
			matchHistoryTable[(document["MatchNumber"]-1)*4][5] = str(document["Score"]["Total"]["Red"]) + "-" + str(document["Score"]["Total"]["Blue"])
			matchHistoryTable[((document["MatchNumber"]-1)*4)+1][5] = str(document["Score"]["Total"]["Red"]) + "-" + str(document["Score"]["Total"]["Blue"])
			matchHistoryTable[((document["MatchNumber"]-1)*4)+2][5] = str(document["Score"]["Total"]["Red"]) + "-" + str(document["Score"]["Total"]["Blue"])
			matchHistoryTable[((document["MatchNumber"]-1)*4)+3][5] = str(document["Score"]["Total"]["Red"]) + "-" + str(document["Score"]["Total"]["Blue"])
		return matchHistoryTable

	def rpData(self, rows, matchHistoryTable):
		for document in self.cursor:
			for i in range(0,rows):
				if str(document["MatchInformation"]["MatchNumber"]) == str(matchHistoryTable[i][0]) and str(document["MatchInformation"]["TeamNumber"]) == str(matchHistoryTable[i][2]):
					matchHistoryTable[i][7] = str(document["GameInformation"]["AUTO"]["RobotParking"])
					matchHistoryTable[i][8] = str(document["GameInformation"]["AUTO"]["ParticlesCenter"])
					matchHistoryTable[i][9] = str(document["GameInformation"]["AUTO"]["ParticlesCorner"])
					matchHistoryTable[i][10] = str(document["GameInformation"]["AUTO"]["CapBall"])
					matchHistoryTable[i][11] = str(document["GameInformation"]["AUTO"]["ClaimedBeacons"])
					matchHistoryTable[i][12] = str(document["GameInformation"]["DRIVER"]["ParticlesCenter"])
					matchHistoryTable[i][13] = str(document["GameInformation"]["DRIVER"]["ParticlesCorner"])
					matchHistoryTable[i][14] = str(document["GameInformation"]["END"]["AllianceClaimedBeacons"])
					matchHistoryTable[i][15] = str(document["GameInformation"]["END"]["CapBall"])
		return matchHistoryTable
		
	def translate(self, rows, matchHistoryTable):
		for i in range(0, rows):
			if matchHistoryTable[i][7] == "Partially On Center Vortex":
				matchHistoryTable[i][7] = "Partially Center"
			if matchHistoryTable[i][7] == "Partially On Corner Vortex":
				matchHistoryTable[i][7] = "Partially Corner"
			if matchHistoryTable[i][7] == "Fully On Center Vortex":
				matchHistoryTable[i][7] = "Fully Center"
			if matchHistoryTable[i][7] == "Fully On Corner Vortex":
				 matchHistoryTable[i][7] = "Fully Corner"
			if matchHistoryTable[i][15] == "Raised Off The Floor":
				matchHistoryTable[i][15] = "Raised Off Floor"
			if matchHistoryTable[i][15] == "Scored In Center Vortex":
				matchHistoryTable[i][15] = "In Center Vortex"
		return matchHistoryTable
		
	def rp(self, rows, matchHistoryTable):
		for i in range(0,rows):
			totalRp = 0
			if matchHistoryTable[i][7] != "":
				if matchHistoryTable[i][7] == "Partially On Center Vortex" or matchHistoryTable[i][7] == "Partially on Corner Vortex":
					totalRp += 5
				if matchHistoryTable[i][7] == "Fully On Center Vortex" or matchHistoryTable[i][7] == "Fully on Corner Vortex":
					totalRp += 10
				totalRp += int(matchHistoryTable[i][8]) * 15
				totalRp += int(matchHistoryTable[i][9]) * 5
				if matchHistoryTable[i][10] == "Yes":
					totalRp += 5
				totalRp += int(matchHistoryTable[i][11]) * 30
				totalRp += int(matchHistoryTable[i][12]) * 5
				totalRp += int(matchHistoryTable[i][13])
				totalRp += int(matchHistoryTable[i][14]) * 10
				if matchHistoryTable[i][15] == "Raised Off The Floor":
					totalRp += 10
				if matchHistoryTable[i][15] == "Raised Above Vortex":
					totalRp += 20
				if matchHistoryTable[i][15] == "Scored In Center Vortex":
					totalRp += 40
				matchHistoryTable[i][6] = totalRp
		return matchHistoryTable
		
	def printMatchHistory(self, rows, columns, matchHistoryTable):
		for i in range(0,rows):
			for k in range(0,columns):
				print(matchHistoryTable[i][k])
				
		
	def __init__(self, collectionName):
	
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = eval("db."+collectionName)

		foundation = Foundation(collectionName, "rainbow")
		
		totalMatchNumbers = foundation.TotalMatches()
		
		oprInstance = Opr(collectionName)
		oprScore = oprInstance.getOprArray()
		
		rows = totalMatchNumbers * 4
		columns = 16
		matchHistoryTable = [["" for x in range(columns)] for y in range(rows)] 
		
		
		self.matchNumber(rows, matchHistoryTable)
		self.alliance(rows, matchHistoryTable)
		self.cursor = collection.find({'MetaData.MetaData' : 'ScheduleInput', "MetaData.InputID" : "rainbow"})
		self.teamNumber(rows, matchHistoryTable)
		self.teamName(rows, matchHistoryTable)
		self.cursor = collection.find({'MetaData.MetaData' : 'ScheduleInput', "MetaData.InputID" : "rainbow"})
		self.opr(rows, matchHistoryTable, oprScore)
		self.cursor = collection.find({'MetaData.MetaData' : 'ResultsInput', "MetaData.InputID" : "rainbow"})
		self.result(rows, matchHistoryTable)
		self.cursor = collection.find({'MetaData.MetaData' : 'MatchInput', "MetaData.InputID" : "rainbow"})
		self.rpData(rows, matchHistoryTable)
		self.rp(rows, matchHistoryTable)
		self.translate(rows, matchHistoryTable)
		#self.printMatchHistory(rows, columns, matchHistoryTable)
		
		collection.delete_many({"MetaData.MetaData": "MatchOutput"})
		
		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "MatchOutput"
		finalDictionary["MetaData"]["TimeStamp"] = "anytime"
		finalDictionary["MetaData"]["InputID"] = "rainbow"
		finalDictionary["MatchHistory"] = matchHistoryTable;
		collection.insert_one(finalDictionary)
		
		
				
#test = MatchOutput("Y201702052")