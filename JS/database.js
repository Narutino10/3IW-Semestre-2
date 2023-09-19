const { Pool } = require('pg');
const config = require('./config');

class Database {
  constructor() {
    if (Database.instance) {
      return Database.instance;
    }

    // Initialiser la connexion à la base de données
    this.pool = new Pool({
      user: 'postgres',
      host: '213.32.90.66',
      database: 'five',
      password: 'root',
      port: '5432',
    });

    // Conserver l'instance unique de la classe
    Database.instance = this;
  }

  async query(sql) {
    const client = await this.pool.connect();
    try {
      const result = await client.query(sql);
      return result.rows;
    } finally {
      client.release();
    }
  }
}

// Exporter une seule instance de la classe Database
module.exports = new Database();
