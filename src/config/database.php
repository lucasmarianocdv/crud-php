<?php

Define('DB_CONNECTION_TYPE', 'pgsql');
Define('DB_HOST', getenv('DB_HOST') ?: 'postgres_db');
Define('DB_PORT', getenv('DB_PORT') ?: '5432');
Define('DB_DATABASE', getenv('DB_DATABASE') ?: 'usuarioscdv');
Define('DB_USERNAME', getenv('DB_USERNAME') ?: 'lucascdv');
Define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '1234');
Define('DB_CHARSET', 'utf8')

?>