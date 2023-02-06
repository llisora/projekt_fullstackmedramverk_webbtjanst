<h1>Laravel API</h1><br>
<p>Detta är ett API skapat med Laravel för projektuppgift i kursen Fullstacks-utveckling med Ramverk</p>

<h1>Användning API</h1><br>
  
<table>
<thead>
<tr>
<th>Metod</th>
<th>Ändpunkt</th>
<th>Beskrivning</th>
</tr>
</thead>
<tbody>
<tr>
<td>GET</td>
<td>/api/products</td>
<td>Hämtar alla produkter i databasen.</td>
</tr>
<tr>
<td>GET</td>
<td>/api/products/id</td>
<td>Hämtar en specifik produkt med angivet ID.</td>
</tr>
<tr>
<td>POST</td>
<td>/api/products</td>
<td>Lagrar ny data. Kräver att ett objekt skickas med, dvs en produkt</td>
</tr>
<tr>
<td>PUT</td>
<td>/api/products/id</td>
<td>Uppdaterar en existerande produkt med angivet ID. Kräver att ett objekt skickas med, dvs en ny produkt</td>
</tr>
<tr>
<td>DELETE</td>
<td>/api/products/id</td>
<td>Raderar en produkt med angivet ID.</td>
</tr>
</tbody>
</table>

  
  <h1>Produkt</h1>
  Ett produkt-objekt returneras/skickas som JSON med följande struktur:
  
    {
    "id": "8",
    "productname": "Jul-ljus",
    "description": "ett ljus som doftar jul",
    "price": "49",
    "amount": "5",
    "category_id": "6"
  
  
  
  
