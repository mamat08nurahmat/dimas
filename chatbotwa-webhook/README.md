# crud-php-oop-mysqli
kubectl run chatbotwa --image=mamat08nurahmat/chatbotwa --replicas=10 --port=8081
kubectl expose deployment chatbotwa --port=80 --type=LoadBalancer 
**cek-->kubectl get services -o wide
**http://35.222.36.64/index.php
!!https://kubernetes.io/zh/docs/concepts/workloads/controllers/deployment/

$ kubectl set image deployment/chatbotwa-webhook chatbotwa-webhook=mamat08nurahmat/chatbotwa-webhook:v4

$ kubectl rollout status deployment/chatbotwa-webhook

//http://35.232.20.194:1111/webhook.php?server=prod
//http://35.232.20.194:1111/webhook.php?server=dev