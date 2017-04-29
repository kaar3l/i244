<h1>MySQL käsud</h1>
<b>Puuris 1 elavad loomad:</b>
<br>
SELECT * FROM `loomaaed` WHERE cage=1;
<br><br>
<b>Maksimaalne/Minimaalne vanus:</b>
<br>
SELECT MAX(Age) AS MaxAge, MIN(Age) AS MinAge FROM loomaaed 
<br><br>
<b>Minimaalne vanus:</b>
<br>
SELECT COUNT(cage) AS LoomiPuuris, Id AS PuuriNR
FROM loomaaed
GROUP BY Cage
ORDER BY COUNT(Cage) DESC;
<br><br>
<b>Vanuse suurendamine 1 võrra:</b>
<br>
UPDATE loomaaed SET age=age+1;
