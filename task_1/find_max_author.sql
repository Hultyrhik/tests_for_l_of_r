SELECT `имя`, `фамилия`
FROM `авторы`
WHERE `id` = (
    SELECT `автор` FROM (
        SELECT COUNT(`автор`) AS `количество`, `автор`
        FROM `авторство`
        GROUP BY `автор`
        ORDER BY `количество` DESC
        LIMIT 1
    ) AS `finding max`
)
;
