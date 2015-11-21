#!/bin/bash

COMMAND=$1

case "${COMMAND}" in
	up)
		osascript -e 'tell application "System Events"
		key code 113
		end tell'
	;;

	down)
		osascript -e 'tell application "System Events"
		key code 107
		end tell'
	;;
	*)
		echo "Usage: $0 {up|down}"
		exit 1
	;;
esac
