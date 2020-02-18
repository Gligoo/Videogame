## requête avec jointure pour récupérer la liste des jeux et le nom de l'éditeur correspondant à chaque jeux
```sql
SELECT 
    videogame.id AS videogame_id, 
    videogame.name AS videogame_name, 
    videogame.editor AS videogame_editor, 
    videogame.release_date AS videogame_release_date, 
    platform.name AS platform_name 
FROM videogame 
JOIN platform 
    ON platform.id = videogame.platform_id
```