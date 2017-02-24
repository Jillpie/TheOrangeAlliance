#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class Output(Foundation):
	def __init__(self, collectionName):
	
		client = MongoClient()
		db = client.TheOrangeAlliance
		collection = eval("db."+collectionName)
		
		foundation = Foundation(collectionName)
		teamList = foundation.UniqueTeamList()
		
		cursorRankings = collection.find({'MetaData.MetaData' : 'RankingsData'})
		cursorOPRCCWM = collection.find({'MetaData.MetaData' : 'OPRCCWMData'})
		cursorStatistics = collection.find({'MetaData.MetaData' : 'StatisticsData'})
		cursorAverageScoresData = collection.find({'MetaData.MetaData' : 'AverageScoresData'})
		
		RankingsOutput = {}
		RankingsOutput["MetaData"] = {}
		RankingsOutput["MetaData"]["MetaData"] = "RankingsOutput"
		RankingsOutput["MetaData"]["TimpStamp"] = 7
		RankingsOutput["MetaData"]["DatePlace"] = collectionName
		RankingsOutput["MetaData"]["InputID"] = "rainbow"
		RankingsOutput["Rankings"] = {}
		
		for document in cursorRankings:
			for team in teamList:
				RankingsOutput["Rankings"]["TeamNumber" + str(team)] = {}
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["TeamNumber"] = team
				RankingsOutput["Rankings"]["TeamNumber" + str(team)]["TeamName"] = foundation.TeamName(team)
				if document["Rankings"]["TeamNumber" + str(team)]["TeamNumber"] == team:
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["Rank"] = document["Rankings"]["TeamNumber" + str(team)]["Rank"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RecordWin"] = document["Rankings"]["TeamNumber" + str(team)]["RecordWin"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RecordTie"] = document["Rankings"]["TeamNumber" + str(team)]["RecordTie"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RecordLose"] = document["Rankings"]["TeamNumber" + str(team)]["RecordLose"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["QP"] = document["Rankings"]["TeamNumber" + str(team)]["QP"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RP"] = document["Rankings"]["TeamNumber" + str(team)]["RP"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["RP"] = document["Rankings"]["TeamNumber" + str(team)]["RP"]
		
		for document in cursorOPRCCWM:
			for team in teamList:
				if document["OPRCCWM"]["TeamNumber" + str(team)]["TeamNumber"] == team:
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["CCWM"] = document["OPRCCWM"]["TeamNumber" + str(team)]["CCWM"]
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["OPR"] = document["OPRCCWM"]["TeamNumber" + str(team)]["OPR"]
				
		for document in cursorStatistics:
			for team in teamList:
				if document["Statistics"]["Growth"]["TeamNumber" + str(team)]["TeamNumber"] == team:
					RankingsOutput["Rankings"]["TeamNumber" + str(team)]["Growth"] = document["Statistics"]["Growth"]["TeamNumber" + str(team)]["Growth"]
					
		for document in cursorAverageScoresData:
			for team in teamList:
				print(document["AverageScores"]["TeamNumber" + str(team)]["TeamNumber"])
				#if document["AverageScores"]["TeamNumber" + str(team)]["TeamNumber"] == team:
					#RankingsOutput["Rankings"]["TeamNumber" + str(team)]["AverageAUTO"] = document["AverageSocres"]["TeamNumber" + str(team)]["AverageScores"]["AverageAUTO"]
					#RankingsOutput["Rankings"]["TeamNumber" + str(team)]["AverageDRIVER"] = document["AverageSocres"]["TeamNumber" + str(team)]["AverageScores"]["AverageDRIVER"]
					#RankingsOutput["Rankings"]["TeamNumber" + str(team)]["AverageEND"] = document["AverageSocres"]["TeamNumber" + str(team)]["AverageScores"]["AverageEND"]
					#RankingsOutput["Rankings"]["TeamNumber" + str(team)]["AverageAccuracy"] = document["AverageSocres"]["TeamNumber" + str(team)]["AverageScores"]["AverageAccuracy"]
		
		
				
		#for document in cursorRankings:
			#for documentRankings in document["Rankings"].values():
				#for team in teamList:
					#print("Comparing")
					#print(team)
					#pprint(documentRankings["TeamNumber"])
					#if team == documentRankings["TeamNumber"]:
						#RankingsOutput["Rankings"]["Rank"+str(documentRankings["Rank"])] = {}
						#print("Added")
						#print(str(documentRankings["Rank"]))
						#print("Next____________________________________")
		
		pprint(RankingsOutput)
		
		
test = Output("Y201702255")