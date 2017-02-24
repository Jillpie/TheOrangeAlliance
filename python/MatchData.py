#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class MatchData(Foundation):
		
	def __init__(self, collectionName):
	
		client = MongoClient()
		db = client.TheOrangeAlliance
		collection = eval("db."+collectionName)
		
		foundation = Foundation(collectionName)
		teamList = foundation.UniqueTeamList()
		matchesThatTeamPlayedAndAlliance = foundation.WhichMatchesDidThatTeamPlayAndWhatAllaince(teamList, collectionName)
		
		finalDictionary = {}
		finalDictionary["MetaData"] = {}
		finalDictionary["MetaData"]["MetaData"] = "MatchData"
		finalDictionary["MetaData"]["TimeStamp"] = 7
		finalDictionary["MetaData"]["DatePlace"] = collectionName
		finalDictionary["MetaData"]["InputID"] = "Data"
		finalDictionary["MatchHistory"] = {}

		
		for team in teamList:
			tempBlue = matchesThatTeamPlayedAndAlliance[team]["Blue"]
			tempRed = matchesThatTeamPlayedAndAlliance[team]["Red"]
			finalDictionary["MatchHistory"]["" + str(team)] = {}
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])] = {}
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])]["AllianceBlue"] = {}
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])]["AllianceBlue"]["TeamNumber"] = team
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])]["AllianceBlue"]["MatchNumber"] = tempBlue[i]
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])]["AllianceBlue"]["Alliance"] = "Blue"
			for matchNumber in tempBlue:
				cursorResults = collection.find({'MetaData.MetaData' : 'ResultsInput', "ResultsInformation.MatchNumber" : matchNumber })
				for documentResults in cursorResults:
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["ResultRed"] = documentResults["Score"]["Total"]["Red"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["ResultBlue"] = documentResults["Score"]["Total"]["Blue"]
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])]["AllianceBlue"]["AUTO"] = {}
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])]["AllianceBlue"]["DRIVER"] = {}
			for i in range(0, len(tempBlue)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempBlue[i])]["AllianceBlue"]["END"] = {}
			for matchNumber in tempBlue:
				cursorResults = collection.find({'MetaData.MetaData' : 'MatchInput', "MatchInformation.MatchNumber" : matchNumber, "MatchInformation.TeamNumber" : team })
				for documentResults in cursorResults:
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["Parking"] = documentResults["GameInformation"]["AUTO"]["RobotParking"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CenterParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CornerParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["CapBall"] = documentResults["GameInformation"]["AUTO"]["CapBall"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["AUTO"]["Beacons"] = documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"]["CenterParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["DRIVER"]["CornerParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"]["Beacons"] = documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceBlue"]["END"]["CapBall"] = documentResults["GameInformation"]["END"]["CapBall"]
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])] = {}
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])]["AllianceRed"] = {}
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])]["AllianceRed"]["TeamNumber"] = team
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])]["AllianceRed"]["MatchNumber"] = tempRed[i]
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])]["AllianceRed"]["Alliance"] = "Red"
			for matchNumber in tempRed:
				cursorResults = collection.find({'MetaData.MetaData' : 'ResultInput', "ResultsInformation.MatchNumber" : matchNumber})
				for documentResults in cursorResults:
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["ResultRed"] = documentResults["Score"]["Total"]["Red"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["ResultBlue"] = documentResults["Score"]["Total"]["Blue"]
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])]["AllianceRed"]["AUTO"] = {}
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])]["AllianceRed"]["DRIVER"] = {}
			for i in range(0, len(tempRed)):
				finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(tempRed[i])]["AllianceRed"]["END"] = {}
			for matchNumber in tempRed:
				cursorResults = collection.find({'MetaData.MetaData' : 'MatchInput', "MatchInformation.MatchNumber" : matchNumber, "MatchInformation.TeamNumber" : team })
				for documentResults in cursorResults:
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["Parking"] = documentResults["GameInformation"]["AUTO"]["RobotParking"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CenterParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CornerParticles"] = documentResults["GameInformation"]["AUTO"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["CapBall"] = documentResults["GameInformation"]["AUTO"]["CapBall"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["AUTO"]["Beacons"] = documentResults["GameInformation"]["AUTO"]["ClaimedBeacons"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"]["CenterParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCenter"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["DRIVER"]["CornerParticles"] = documentResults["GameInformation"]["DRIVER"]["ParticlesCorner"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"]["Beacons"] = documentResults["GameInformation"]["END"]["AllianceClaimedBeacons"]
					finalDictionary["MatchHistory"]["" + str(team)]["MatchNumber" + str(matchNumber)]["AllianceRed"]["END"]["CapBall"] = documentResults["GameInformation"]["END"]["CapBall"]
		
		collection.delete_many({"MetaData.MetaData": "MatchData"})
		collection.insert_one(finalDictionary)
		
		
				

#test = MatchData("Y201702255")