#!/usr/bin/env bash

progress-bar() {
  local duration=${1}


    already_done() { for ((done=0; done<$elapsed; done++)); do printf "▇"; done }
    remaining() { for ((remain=$elapsed; remain<$duration; remain++)); do printf " "; done }
    percentage() { printf "| %s%%" $(( (($elapsed)*100)/($duration)*100/100 )); }
    clean_line() { printf "\r"; }

  for (( elapsed=1; elapsed<=$duration; elapsed++ )); do
      already_done; remaining; percentage
      sleep 1
      clean_line
  done
  clean_line
}


docker stop mysql-container;
docker stop nginx-container;
docker stop app-container;
docker rm mysql-container;
docker rm nginx-container;
docker rm app-container;
docker-compose down;

docker-compose up -d --build

# wait before container to respond
echo -e "\033[32mwaiting container"
progress-bar 2

docker exec -t app-container sh  -c 'composer update'
docker exec -t app-container sh  -c 'php artisan key:generate;'
docker exec -t app-container sh  -c 'php artisan ide:generate;'
docker exec -t app-container sh  -c 'php artisan migrate;'