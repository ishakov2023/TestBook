1.Запустить команду docker-compose up -d
2.Раздать права docker exec app_php_1 chmod +x /app/yii
3.Установить библиотеки docker exec app_php_1 bash composer i
4.Накатить миграции docker exec app_php_1 yii migrate
