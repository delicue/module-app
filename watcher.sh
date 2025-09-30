#!/bin/bash
# watcher.sh: Watch for PHP file changes and restart 'php serve' after 2 seconds of inactivity

WATCH_DIR="$(pwd)"
DEBOUNCE=2
CMD="php serve"

# Function to kill the previous process
kill_serve() {
    if [[ -n "$SERVE_PID" ]] && kill -0 "$SERVE_PID" 2>/dev/null; then
        kill "$SERVE_PID"
        wait "$SERVE_PID" 2>/dev/null
    fi
}

SERVE_PID=""
LAST_EVENT=0

start_serve() {
    $CMD &
    SERVE_PID=$!
    echo "Started $CMD with PID $SERVE_PID"
}

kill_serve
start_serve

# Watch for changes
while true; do
    CHANGED=$(find "$WATCH_DIR" -type f -name '*.php' -print0 | xargs -0 stat -f "%m %N" | md5)
    if [[ "$CHANGED" != "$LAST_EVENT" ]]; then
        LAST_EVENT="$CHANGED"
        echo "Change detected. Waiting $DEBOUNCE seconds before restarting..."
        sleep $DEBOUNCE
        # Check again to avoid double-restart if more changes during debounce
        CHANGED2=$(find "$WATCH_DIR" -type f -name '*.php' -print0 | xargs -0 stat -f "%m %N" | md5)
        if [[ "$CHANGED2" != "$LAST_EVENT2" ]]; then
            kill_serve
            start_serve
            LAST_EVENT2="$CHANGED2"
        fi
    fi
    sleep 1
done
