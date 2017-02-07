#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation
from OPR import Opr

class RankingsOutput(Foundation):
	
	def teamNumbers(self, rows, rankingsTable, teamList):
		for i in range(0,rows):
			rankingsTable[i][1] = teamList[i]
		return rankingsTable
		
	def teamName(self, rows, rankingsTable, teamList):
		for i in range(0, rows):
			rankingsTable[i][2] = self.TeamName(rankingsTable[i][1])
		return rankingsTable
		
	def WhichMatchesDidThatTeamPlayAndWhatAllaince(self, teamList):
		teamList = teamList
		matchesThatTeamPlayedAndAlliance = {}
		for document in self.cursor:
			for team in teamList:
				matchListRed = []
				matchListBlue = []
				for matchNumber in range(1, len(document['Match'].values()) + 1):
					for alliance, teamOnThatAlliance in document['Match']['Match' + str(matchNumber)].items():
						if alliance == 'Red1' or alliance == 'Red2':
							if teamOnThatAlliance == team:
								matchListRed.append(matchNumber)
						if alliance == 'Blue1' or alliance == 'Blue2':
							if teamOnThatAlliance == team:
								matchListBlue.append(matchNumber)
				matchesThatTeamPlayedAndAlliance.update({team : {'Red' : matchListRed , 'Blue' : matchListBlue}})
		return matchesThatTeamPlayedAndAlliance
		
	def QPAndRPAndRecord(self, rows, rankingsTable, teamList, matchesThatTeamPlayedAndAlliance):
		teamRecord = [[0 for x in range(4)] for y in range(rows)] 
		teamRP = [0 for x in range(len(teamList))]
		for document in self.cursor:
			for i in range(0,len(teamList)):
				win = 0
				loss = 0
				tie = 0
				RP = 0
				recordPrint = ''
				record = []
				for matchThatTeamPlayedOnRed in matchesThatTeamPlayedAndAlliance[teamList[i]]['Red']:
					if document['MatchNumber'] == matchThatTeamPlayedOnRed:
						if document['Winner'] == 'Red':
							RP += document['Score']['Total']['Blue']
							win += 1
						elif document['Winner'] == 'Blue':
							RP += document['Score']['Total']['Red']
							loss += 1
						elif document['Winner'] == 'Tie':
							RP += document['Score']['Total']['Red']
							tie += 1
						else:
							win += 100000000
				for matchThatTeamPlayedOnBlue in matchesThatTeamPlayedAndAlliance[teamList[i]]['Blue']:
					if document['MatchNumber'] == matchThatTeamPlayedOnBlue:
						if document['Winner'] == 'Blue':
							RP += document['Score']['Total']['Red']
							win += 1
						elif document['Winner'] == 'Red':
							RP += document['Score']['Total']['Blue']
							loss += 1
						elif document['Winner'] == 'Tie':
							RP += document['Score']['Total']['Blue']
							tie += 1
						else:
							win += 100000000



				totalWin = win + teamRecord[i][0]
				totalLoss = loss + teamRecord[i][1]
				totalTie = tie + teamRecord[i][2]

				teamRecord[i][0] = totalWin
				teamRecord[i][1] = totalLoss
				teamRecord[i][2] = totalTie

				teamRP[i] = RP + teamRP[i]

				recordPrint = str(teamRecord[i][0]) + '-' + str(teamRecord[i][1]) + '-' + str(teamRecord[i][2])
				rankingsTable[i][3] = recordPrint

			#QP
				rankingsTable[i][4] = teamRecord[i][0] * 2 + teamRecord[i][2]
			#RP
				rankingsTable[i][5] = teamRP[i]

		
	def ranking(self, rows, rankingsTable, teamList):
		tempArray = {}
		for i in range(0, rows):
			 tempArray[i]= (int(rankingsTable[i][4]) *10000) + rankingsTable[i][5]
		for j in range(0, rows):
			teamRank = 1
			for k in range(0, rows):
				if tempArray[j] < tempArray[k]:
					teamRank += 1
				rankingsTable[j][0] = teamRank
		return rankingsTable
		
	def OPR(self, rows, rankingsTable, teamList, oprScore):
		for i in range(0, rows):
			rankingsTable[i][6] = oprScore[i]
		return rankingsTable
		
	def addRP(self, rows, rankingsTable, teamList):
		tempTable = [[0 for x in range(3)] for y in range(rows)] 
		tempTable[9][1] = 20
		tempTable[3][1] = 20
		tempTable[12][1] = 20
		tempTable[14][1] = 20
		tempTable[4][1] = 20
		tempTable[6][1] = 20
		tempTable[10][1] = 18
		tempTable[2][1] = 18
		tempTable[8][1] = 15
		tempTable[7][1] = 14
		tempTable[0][1] = 14
		tempTable[15][1] = 12
		tempTable[1][1] = 12
		tempTable[13][1] = 12
		tempTable[11][1] = 6
		tempTable[5][1] = 3
		tempTable[9][0] = 4216
		tempTable[3][0] = 11128
		tempTable[12][0] = 8097
		tempTable[14][0] = 10809
		tempTable[4][0] = 8742
		tempTable[6][0] = 3650
		tempTable[10][0] = 12073
		tempTable[2][0] = 3712
		tempTable[8][0] = 7159
		tempTable[7][0] = 3513
		tempTable[0][0] = 11288
		tempTable[15][0] = 11411
		tempTable[1][0] = 4278
		tempTable[13][0] = 9367
		tempTable[11][0] = 9837
		tempTable[5][0] = 10390
		tempTable[9][2] = 667
		tempTable[3][2] = 610
		tempTable[12][2] = 457
		tempTable[14][2] = 451
		tempTable[4][2] = 406
		tempTable[6][2] = 399
		tempTable[10][2] = 410
		tempTable[2][2] = 308
		tempTable[8][2] = 441
		tempTable[7][2] = 491
		tempTable[0][2] = 361
		tempTable[15][2] = 427
		tempTable[1][2] = 425
		tempTable[13][2] = 355
		tempTable[11][2] = 466
		tempTable[5][2] = 120
		
		for i in range(0, rows):
			rankingsTable[i][4] += tempTable[i][1]
			rankingsTable[i][5] += tempTable[i][2] 
			print '--------------------Rankings Table----------------'
			print rankingsTable[i][2]
			print tempTable[i][2]
		return rankingsTable
		
			
		
		
	def printRankings(self, rows, columns, rankingsTable):
		for i in range(0,rows):
			for k in range(0,columns):
				print(rankingsTable[i][k])
				
		
	def __init__(self, collectionName):
	
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = eval("db."+collectionName)

		foundation = Foundation(collectionName, "rainbow")
		teamList = foundation.UniqueTeamList()
		
		oprInstance = Opr(collectionName)
		oprScore = oprInstance.getOprArray()
		
		rows = len(teamList)
				
		columns = 7
		
		rankingsTable = [[0 for x in range(columns)] for y in range(rows)] 
		
		print 'Unique team list: '
		pprint(teamList)
		self.teamNumbers(rows, rankingsTable, teamList)
		self.teamName(rows, rankingsTable, teamList)
		self.cursor = collection.find({'MetaData.MetaData' : 'ScheduleInput', "MetaData.InputID" : "rainbow"})
		matchesThatTeamPlayedAndAlliance = self.WhichMatchesDidThatTeamPlayAndWhatAllaince(teamList)
		self.cursor = collection.find({'MetaData.MetaData' : 'ResultsInput', "MetaData.InputID" : "rainbow"})
		self.QPAndRPAndRecord(rows, rankingsTable, teamList, matchesThatTeamPlayedAndAlliance)
		self.OPR(rows, rankingsTable, teamList, oprScore)
		self.addRP(rows, rankingsTable, teamList)
		self.ranking(rows, rankingsTable, teamList)
		self.printRankings(rows, columns, rankingsTable)
		
		collection.delete_many({"MetaData.MetaData": "RankingsOutput"})
		
		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "RankingsOutput"
		finalDictionary["MetaData"]["TimeStamp"] = "anytime"
		finalDictionary["MetaData"]["InputID"] = "rainbow"
		finalDictionary["Rankings"] = rankingsTable;
		collection.insert_one(finalDictionary)
				
				
test = RankingsOutput("Y201702052")