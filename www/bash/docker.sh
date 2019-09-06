#!/bin/bash

CMD=$1

IMAGE_TAG=$2
DOCKER_USER="mamat08nurahmat"
IMAGE_NAME="mamat08nurahmat/dimas"
CONTAINER_NAME="dimas"
CONTAINER_NAME_DEV="dimas_dev"


case $CMD in
    build)
        docker build -t $IMAGE_NAME:$IMAGE_TAG .
        ;;

    build_dev)
        docker build -f Dockerfile_Dev -t $IMAGE_NAME:$IMAGE_TAG .
        ;;

    run)
        CMD="docker run"
        CMD="$CMD -d"
        CMD="$CMD --name $CONTAINER_NAME"
        CMD="$CMD -p 8888:80"
        CMD="$CMD -td $IMAGE_NAME:$IMAGE_TAG"
        echo "$CMD"
        eval $CMD
        ;;

    run_dev)
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


    login)
        CMD="docker login"
        CMD="$CMD -u"
        CMD="$CMD  $DOCKER_USER"
        CMD="$CMD -p"
        CMD="$CMD $2"
        echo "$CMD"
        eval $CMD
        ;;


    rmi)
        docker rmi -f $IMAGE_NAME:$IMAGE_TAG
        ;;


    pull)
        CMD="docker pull"
        CMD="$CMD $IMAGE_NAME:$IMAGE_TAG"
        echo "$CMD"
        eval $CMD
        ;;

    code)
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
