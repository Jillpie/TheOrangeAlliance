#! /usr/bin/python

#Import
from pymongo import MongoClient
from pprint import pprint

print '-----START OF FOUNDATION-----'
class HelpfulMethods(object):
	'Some Functions that I just like to use'

	def __init__(self):
		print 'In the init!'

	def GenerateUniqueList(self, ununiqueList):
		"Generates a unique list based off the not unique list"
		uniqueList = []
		for thing in ununiqueList:
			if not thing in uniqueList:
				uniqueList.append(thing)
		return uniqueList

class Foundation(object):
	'I am a CLASSSSSS!'

	def __init__(self, collectionName, dataValidation, debug = False):
		#MongoStuff
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = eval("db."+collectionName)
		self.cursor = collection.find({'MetaData.MetaData' : 'ScheduleInput'})

		#Varibles
		self.collectionName = collectionName
		self.dataValidation = dataValidation
		self.debug = debug

	#Functions
	def Debuger(self, statment):
		"Enables debugging, prints statment if true"
		if self.debug == True:
			print(statment)
			
	def GenerateUniqueList(self, ununiqueList):
		"Generates a unique list based off the not unique list"
		uniqueList = []
		for indexUnuniqueList in range(len(ununiqueList)):
			if not ununiqueList[indexUnuniqueList] in uniqueList:
				uniqueList.append(ununiqueList[indexUnuniqueList])
		return uniqueList

	def UniqueTeamList(self):
		"Produces the unique list of teams from schedule"
		ununiqueTeamList = []
		for document in self.cursor:
			for match in document['Match'].values():
				for team in match.values():
					ununiqueTeamList.append(team)
		return self.GenerateUniqueList(ununiqueTeamList)

	def TotalMatches(self):
		"Returns the amount of matches in schedule int"
		self.Debuger('FUNCTION: Total Mathes')
		totalMatches = 0
		for document in self.cursor:
			totalMatches = len(document['Match'])
		self.Debuger('Total Matches return: ' + str(totalMatches))
		return totalMatches

	def TeamName(self, teamNumber):
		#MongoStuff
		client = MongoClient()
		db = client.TheOrangeAllianceTest
		collection = db.Teams
		nameCursor = collection.find({'MetaData.MetaData' : 'TeamList'})
		teamName = 'NO NAME FOUND'
		for document in nameCursor:
			for teamNumberValue, teamNameValue in document['TeamInformation'].items():
				if str(teamNumber) == teamNumberValue:
					teamName = teamNameValue
		return teamName

print '-----END OF FOUNDATION-----'
