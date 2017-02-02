#! /usr/bin/python

import time
import shlex
import subprocess

MatchOutputProcess = subprocess
AverageScoresOutputProcess = subprocess

while True:

	MatchOutput = MatchOutputProcess.Popen((['python MatchOutput.py']), shell=True)
	AverageScoresOutput = AverageScoresOutputProcess.Popen((['python AverageScoresOutput.py']), shell=True)

	MatchOutput.pid()
	AverageScoresOutput.pid()
	print 'part one'
	MatchOutput.kill()
	AverageScoresOutput.kill()
	print 'part two'
	MatchOutput.pid()
	AverageScoresOutput.pid()

	time.sleep(10)

	file = open("/developer/TheOrangeAlliance/python/launcherStatus.txt","w")

	file.write('I am GRUUUUUUUUUUUUUUUU')

	file.close()
