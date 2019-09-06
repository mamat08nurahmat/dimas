#!/bin/bash

#CMD=$1

IMAGE_TAG=$1

IMAGE_NAME="mamat08nurahmat/chatbotwa-webhook"

CONTAINER_NAME_KUBECTL="chatbotwa-webhook"

kubectl set image deployment/$CONTAINER_NAME_KUBECTL $CONTAINER_NAME_KUBECTL=$IMAGE_NAME:$IMAGE_TAG
kubectl rollout status deployment/$CONTAINER_NAME_KUBECTL
