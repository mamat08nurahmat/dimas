#!/bin/bash

CMD=$1

IMAGE_TAG=latest

IMAGE_NAME="mamat08nurahmat/chatbotwa"

CONTAINER_NAME="chatbotwa"
CONTAINER_NAME_DEV="chatbotwa_dev"


case $CMD in
    build)
        docker build -t  $IMAGE_NAME .
        ;;

    start)
        CMD="docker run"
        CMD="$CMD -d"
        CMD="$CMD --name $CONTAINER_NAME"
        CMD="$CMD -p 8888:80"
        CMD="$CMD -td $IMAGE_NAME:$IMAGE_TAG"
        echo "$CMD"
        eval $CMD
        ;;

    start_dev)
        CMD="docker run"
        CMD="$CMD -d"
        CMD="$CMD -v "${PWD}:/var/www/html""
        CMD="$CMD --name $CONTAINER_NAME_DEV"
        CMD="$CMD -p 1111:80"
        CMD="$CMD -td $IMAGE_NAME:$IMAGE_TAG"
        echo "$CMD"
        eval $CMD
        ;;

    stop)
        docker stop $CONTAINER_NAME
        ;;
        
    stop_dev)
        docker stop $CONTAINER_NAME_DEV
        ;;
        
    remove)
        docker rm -f $CONTAINER_NAME
        ;;

    remove_dev)
        docker rm -f $CONTAINER_NAME_DEV
        ;;


    push)
        CMD="docker push"
        CMD="$CMD  $IMAGE_NAME:$IMAGE_TAG"
        echo "$CMD"
        eval $CMD
        ;;

    rmi)
        docker rmi -f $IMAGE_NAME
        ;;


    pull)
        CMD="docker pull"
        CMD="$CMD $IMAGE_NAME:$IMAGE_TAG"
        echo "$CMD"
        eval $CMD
        ;;

    *)
        echo "Usage : build | start <image_tag> | stop | remove | rmi"
        ;;
esac

exit 0
