#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class RankingsOutput(Foundation):

	def teamNumbers(self, rows, rankingsTable, teamList):
		#for i in range(0,rows):
			#rankingsTable[i][1] = teamList[i]
		#return rankingTable
		pass
	def printRankings(self, rows, columns, rankingsTable):
		count = 0
		for i in range(0,rows):
			for k in range(0,columns):
				count += 1
				print(rankingsTable[i][k])
		
	def __init__(self):
	
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = db.test

		foundation = Foundation('rainbow', 1)
		teamList = foundation.UniqueTeamList()
		print(teamList[0])
		
		rows = len(teamList)
		
		print(rows)
		columns = 7
		
		rankingsTable = [[0 for x in range(columns)] for y in range(rows)] 
		
		self.teamNumbers(rows, rankingsTable, teamList)
		#self.printRankings(rows, columns, rankingsTable)
				
				
test = RankingsOutput()