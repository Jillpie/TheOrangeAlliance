#! /usr/bin/python

from pymongo import MongoClient
from pprint import pprint
from Foundation import Foundation

class Validation(Foundation):
		
	def __init__(self, collectionName):
	
		client = MongoClient()
		db = client.TheOrangeAlliance
		collection = eval("db."+collectionName)
		collectionDataValidation = db.DataValidation
		
		foundation = Foundation(collectionName)
		teamList = foundation.UniqueTeamList()
		matchesThatTeamPlayedAndAlliance = foundation.WhichMatchesDidThatTeamPlayAndWhatAllaince(teamList, collectionName)

		#Input Data inputDataDocuments
		cursor = collection.find({'MetaData.MetaData' : 'MatchInputRaw'})
		inputDataDocuments = []
		for document in cursor:
			inputDataDocuments.append(document)
		validationKeyDocuments = []
		cursor = collectionDataValidation.find({'MetaData.MetaData' : 'ValidationKey'})
		for document in cursor:
			validationKeyDocuments.append(document)
		validationKeyHierarchyDocuments = []
		cursor = collectionDataValidation.find({'MetaData.MetaData' : 'ValidationKeyHierarchy'})
		pprint(cursor)
		for document in cursor:
			validationKeyHierarchyDocuments.append(document)


		#finds lowest Type Level 
		lowestTypeLevel = 0
		validationKeyHierarchyType = {}
		validationKeyHierarchyStatus = {}
		for validationKeyHierarchyDocument in validationKeyHierarchyDocuments:
			validationKeyHierarchyType = validationKeyHierarchyDocument['Hierarchy']['TypeLevel']
			validationKeyHierarchyStatus = validationKeyHierarchyDocument['Hierarchy']['StatusLevel']
			pprint(validationKeyHierarchyType)
			pprint(validationKeyHierarchyStatus)
			for typeLevelNames in validationKeyHierarchyDocument['Hierarchy']['TypeLevel'].values():
				if(typeLevelNames > lowestTypeLevel):
					lowestTypeLevel = typeLevelNames
		uniqueMatchInformation = []
		for document in inputDataDocuments:
			if(document['MatchInformation'] not in uniqueMatchInformation):
				uniqueMatchInformation.append(document['MatchInformation'])
		for matchInformation in uniqueMatchInformation:
			#All the keytypes present per match information
			uniqueKeyPool = []
			uniqueKeyTypePool = []
			cleanUniqueKeyPool = []
			highestKeyTypeLevel = lowestTypeLevel
			highestKeyTypePool = []
			highestKeyStatusLevel = validationKeyHierarchyStatus['Default']
			finalKeyPool = []
			#all inputDataDocuments to check though
			for document in inputDataDocuments:
				#if the correct document (via document information) is being used
				if(cmp(document['MatchInformation'],matchInformation) == 0 and document['DataValidation']['ValidationKey'] not in uniqueKeyPool):
					uniqueKeyPool.append(document['DataValidation']['ValidationKey'])
			for uniqueKey in uniqueKeyPool:
				for validationKeyDocument in validationKeyDocuments:
					if(uniqueKey == validationKeyDocument['ValidationKey']['KeyIdentity']['Key']):
						cleanUniqueKeyPool.append(uniqueKey)
						if(validationKeyDocument['ValidationKey']['KeyInformation']['KeyType'] not in uniqueKeyTypePool):
							uniqueKeyTypePool.append(validationKeyDocument['ValidationKey']['KeyInformation']['KeyType'])
			for uniqueKeyType in uniqueKeyTypePool:
				if(highestKeyTypeLevel > validationKeyHierarchyType[uniqueKeyType]):
					highestKeyTypeLevel = validationKeyHierarchyType[uniqueKeyType]
			for cleanUniqueKey in cleanUniqueKeyPool:
				for validationKeyDocument in validationKeyDocuments:
					if(validationKeyDocument['ValidationKey']['KeyIdentity']['Key'] == cleanUniqueKey):
						if(validationKeyHierarchyType[validationKeyDocument['ValidationKey']['KeyInformation']['KeyType']] == highestKeyTypeLevel):
							highestKeyTypePool.append(cleanUniqueKey)				
			for highestKey in highestKeyTypePool:
				for validationKeyDocument in validationKeyDocuments:
					if(validationKeyDocument['ValidationKey']['KeyIdentity']['Key'] == highestKey):
						if(highestKeyStatusLevel > validationKeyHierarchyStatus[validationKeyDocument['ValidationKey']['KeyInformation']['KeyStatus']]):
							highestKeyStatusLevel = validationKeyHierarchyStatus[validationKeyDocument['ValidationKey']['KeyInformation']['KeyStatus']]
			for highestKey in highestKeyTypePool:
				for validationKeyDocument in validationKeyDocuments:
					if(validationKeyDocument['ValidationKey']['KeyIdentity']['Key'] == highestKey):
						if(validationKeyHierarchyStatus[validationKeyDocument['ValidationKey']['KeyInformation']['KeyStatus']] == highestKeyStatusLevel):
							finalKeyPool.append(highestKey)

			#Real stuff set up
			allInputFields = {
				'AUTO' : [
					'RobotParking',
					'ParticlesCenter',
					'ParticlesCorner',
					'CapBall',
					'ClaimedBeacons'
				],
				'DRIVER' : [
					'ParticlesCenter',
					'ParticlesCorner'
				],
				'END' : [
					'AllianceClaimedBeacons',
					'CapBall'
				]
			}
			allInputs = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			allUniqueInputs = {}
			countedInputs = {
				'AUTO' : {
					'RobotParking' : [],
					'ParticlesCenter' : [],
					'ParticlesCorner' : [],
					'CapBall' : [],
					'ClaimedBeacons' : []
				},
				'DRIVER' : {
					'ParticlesCenter' : [],
					'ParticlesCorner' : []
				},
				'END' : {
					'AllianceClaimedBeacons' : [],
					'CapBall' : []
				}
			}
			#Real stuff (if there are any keys present)
			for document in inputDataDocuments:
				if(cmp(document['MatchInformation'],matchInformation) == 0 and document['DataValidation']['ValidationKey'] in finalKeyPool):
					for gamePeriods in allInputFields:
						for gameFields in allInputFields[gamePeriods]:
							allInputs[gamePeriods][gameFields].append(document['GameInformation'][gamePeriods][gameFields])
							print allInputs[gamePeriods][gameFields]
					pprint(document)

			for document in inputDataDocuments:
				if(cmp(document['MatchInformation'],matchInformation) == 0 and document['DataValidation']['ValidationKey'] in finalKeyPool):
					pass

			for gamePeriods in allInputFields:
				for gameFields in allInputFields[gamePeriods]:
					for gameValue in allInputs[gamePeriods][gameFields]:
						countedInputs[gamePeriods][gameFields].append(
							{
								'GameValue' + str(gameValue) :{
									'GameValue' : gameValue
								}
							}
						)
						print '--------------------countedInputs-----------------------------'
						pprint(countedInputs)


			#if no real keys are present
			#if(finalKeyPool == []){
				#for document in inputDataDocuments:
			#}

			print 'uniqueKeyPool'
			pprint(uniqueKeyPool)
			print 'cleanUniqueKeyPool'
			pprint(cleanUniqueKeyPool)
			if(cleanUniqueKeyPool == []):
				print 'cleanUniqueKeyPool is empty'
			print 'uniqueKeyTypePool'
			pprint(uniqueKeyTypePool)
			print 'highestKeyTypeLevel'
			print highestKeyTypeLevel
			print 'highestKeyTypePool'
			pprint(highestKeyTypePool)
			print 'finalKeyPool'
			pprint(finalKeyPool)
			print 'countedInputs'
			pprint(countedInputs)

		#collection.delete_many({"MetaData.MetaData": "MatchData"})
		#collection.insert_one(finalDictionary)
		
		
				

test = Validation("Y201702255Raw")