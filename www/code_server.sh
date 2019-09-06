#!/bin/bash

CMD=$1
case $CMD in
    run)
        CMD="docker rm -f code1234"
        CMD="docker run -d -p 1234:8443 -v "${PWD}:/home/coder/project" --name code1234 codercom/code-server --allow-http --no-auth"
        echo "$CMD"
        eval $CMD
	;;

    rm_f)
        CMD="docker rm -f $(docker ps -aq)"
        # CMD="$(docker ps -aq)"
        echo "$CMD"
        eval $CMD
	;;

    rmi_f)
        CMD="docker rmi -f $(docker images -aq)"
        echo "$CMD"
        eval $CMD
	;;



    *)
        echo "Usage : build | run <image_tag> | stop | remove | rmi"
        ;;
esac

exit 0
