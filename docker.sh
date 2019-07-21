#!/bin/bash

CMD=$1

IMAGE_TAG=latest

IMAGE_NAME="mamat08nurahmat/mattools"

CONTAINER_NAME="mattools"


case $CMD in
    build)
        docker build -t  $IMAGE_NAME .
        ;;

    start)
        CMD="docker run"
        CMD="$CMD -d"
#        CMD="$CMD --net=bridge"
        CMD="$CMD --name $CONTAINER_NAME"
        CMD="$CMD -p 8888:80"
#        CMD="$CMD -e MYSQL_ROOT_PASSWORD=$MYSQL_ROOT_PASSWORD"
        CMD="$CMD -td $IMAGE_NAME:$IMAGE_TAG"
        echo "$CMD"
        eval $CMD
        ;;

    stop)
        docker stop $CONTAINER_NAME
        ;;
    remove)
        docker rm -f $CONTAINER_NAME
        ;;
    rmi)
        docker rmi -f $CONTAINER_NAME
        ;;
    *)
        echo "Usage : build | start <image_tag> | stop | remove | rmi"
        ;;
esac

exit 0
