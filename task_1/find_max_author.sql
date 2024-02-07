SELECT `имя`, `фамилия`
FROM `авторы`
WHERE `id` IN (
    SELECT MAX(`автор`)
    FROM `авторство`
)
;