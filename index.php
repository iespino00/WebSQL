<!DOCTYPE HTML>
<html>

   <head>
	
      <script type="text/javascript">
		
         var db = openDatabase('iespinoDB', '1.0', 'Test DB', 2 * 1024 * 1024);
         var msg;
			
         db.transaction(function (tx) 
         {
            tx.executeSql('CREATE TABLE IF NOT EXISTS TablaLogs (id unique, log)');
            tx.executeSql('INSERT INTO TablaLogs (id, log) VALUES (1, "foobar")');
            tx.executeSql('INSERT INTO TablaLogs (id, log) VALUES (2, "logmsg")');
            msg = '<p>Log message created and row inserted.</p>';
            document.querySelector('#status').innerHTML =  msg;
         });

         db.transaction(function (tx) {
            tx.executeSql('SELECT * FROM TablaLogs', [], function (tx, results) {
               var len = results.rows.length, i;
               msg = "<p>Found rows: " + len + "</p>";
               document.querySelector('#status').innerHTML +=  msg;
					
               for (i = 0; i < len; i++){
                  msg = "<p><b>" + results.rows.item(i).log + "</b></p>";
                  document.querySelector('#status').innerHTML +=  msg;
               }
            }, null);
         });
			
      </script>
		
   </head>
	
   <body>
      <div id="status" name="status">Status Message</div>
   </body>
	
</html>