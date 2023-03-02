const express = require('express');
const bodyParser = require('body-parser');
const morgan = require('morgan');
const mysql = require('mysql');
const PDFDocument = require('pdfkit');
const fs = require('fs');

const app = express();
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(morgan('dev'));

const db = mysql.createConnection({
  host: 'papemanu.mysql.database.azure.com',
  user: 'emanu',
  password: 'P@ssword1',
  database: 'pap',
  port: 3306,
  ssl: {
    ca: fs.readFileSync('ca.pem'),
    cert: fs.readFileSync('ca.pem'),
  }
});

db.connect((err) => {
  if (err) {
    console.error('Erro ao conectar ao banco de dados:', err);
    return;
  }
  console.log('Conexão com o banco de dados estabelecida com sucesso');
});

app.get('/gerar-relatorio-pdf', (req, res) => {
  const { tabela, data_inicio, data_fim } = req.query;
  const query = `SELECT * FROM ${tabela} WHERE datanasc BETWEEN '${data_inicio}' AND '${data_fim}'`;
  console.log('Query:', query);
  db.query(query, (err, results) => {
    if (err) {
      console.error('Erro ao executar a consulta SQL:', err);
      res.status(500).json({ error: 'Erro ao executar a consulta SQL' });
    } else {
      // criar um novo documento PDF
      const doc = new PDFDocument();

      // definir o nome do arquivo PDF de acordo com o tipo de relatório
      const filename = `${tabela}_${data_inicio}_${data_fim}.pdf`;

      // definir o tipo de conteúdo da resposta HTTP como PDF
      res.setHeader('Content-Type', 'application/pdf');

      // definir o cabeçalho da resposta HTTP para indicar que é um anexo
      res.setHeader('Content-Disposition', `attachment; filename="${filename}"`);

      // escrever os dados do relatório no documento PDF
      doc.text(`Relatório ${tabela} de ${data_inicio} a ${data_fim}`);
      doc.moveDown();
      results.forEach((item) => {
        doc.text(`Numero: ${item.numero} - DataNasc: ${item.datanasc} - Especie: ${item.especie} - NumMae: ${item.nummae} - País: ${item.pais} - Observações: ${item.observ} - Inserido em: ${item.timestamp}`);
        doc.moveDown();
      });

      // enviar o documento PDF como resposta HTTP
      doc.pipe(res);
      doc.end();
    }
  });
});

app.listen(3000, () => {
  console.log('Servidor iniciado na porta 3000');
});
