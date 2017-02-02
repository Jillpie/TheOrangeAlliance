#! /usr/bin/python

print '-----IMPORTING: START-----'
import time
import threading
#import Queue
#from pymongo import MongoClient
from pprint import pprint
from LauncherNode import LauncherNode
print '-----IMPORTING: END-----'

class Launcher(object):

	def __init__(self):
		print 'At Lunacher. __init__'
		#MongoStuff
		#client = MongoClient()
		#db = client.TheOrangeAllianceTest
		#collection = db.test
		#self.cursor = collection.find({'MetaData.MetaData' : 'ScheduleInput'})

#Threading Stuff
class ToThread(threading.Thread):
	def __init__(self, threadID, threadName, programName):
		threading.Thread.__init__(self)
		self.threadID = threadID
		self.threadName = threadName
		self.programName = programName
	def run(self):
		print "Starting " + self.name
		RunProgram(self.programName)
		print "Exiting " + self.name

def RunProgram(nameOfProgram):
	if nameOfProgram == "LauncherNode":
		instanceOfLauncherNode = LauncherNode('MY ARGGGGSSSSSS')
		instanceOfLauncherNode.run()
	elif nameOfProgram == "Baka":
		print "You're one of a baka!"
	else:
		print 'Failure to recognize program name: ' + str(nameOfProgram)

print '-----LAUNCHING-----'
#Create new threads
LauncherNodeThread = ToThread(1, 'LauncherNodeThread', 'LauncherNode')
BakaThread = ToThread(2, 'BakaThread', 'Baka')
ExcpetionThread = ToThread(3, 'ExcpetionThread', 'COOLEO')

print '-----THREAD: STRAT-----'
#Start new Threads
try:
	LauncherNodeThread.start()
	BakaThread.start()
	ExcpetionThread.start()
except:
	print '-----THREAD: ERROR IN START-----'

print "-----COMPLETED LAUNCHER THREAD-----"