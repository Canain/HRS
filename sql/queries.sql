--View popular category

SELECT month, category, location, max(num_reservations) as res
FROM
  (SELECT monthname(start_date) AS month, category, location, count(reservation_id) AS num_reservations
   FROM reservation NATURAL JOIN reservation_has_room NATURAL JOIN room
   WHERE monthname(start_date)=:month_name
   GROUP BY category, location
   ORDER BY location) AS s
GROUP BY location;

--View reservation report

SELECT monthname(start_date) AS month, location, count(reservation_id) AS num_reservations
                            FROM reservation NATURAL JOIN reservation_has_room
                            where monthname(start_date)=:month_name
                            GROUP BY month, location
                            ORDER BY month, location;

--View Revenue Report
select monthname(start_date) as month, location, sum(total_cost) as total_revenue
from reservation natural join reservation_has_room
where monthname(start_date)=:month_name
group by location
order by location;

--Write Review
INSERT INTO review VALUES (DEFAULT, :location, :rating, :comment, :username);

--Insert Card
INSERT INTO payment VALUES (:card_no, :cvv, :exp_date, :name, :username);
--Delete Card
delete from payment where card_no=:card_no and username=:username;
--Card dropdown list
SELECT p.card_no % 10000 as last, p.card_no FROM payment AS p WHERE username = :username
AND NOT EXISTS (SELECT * FROM reservation AS r WHERE username = :username
  AND is_cancelled = 0 AND r.card_no = p.card_no
  AND DATEDIFF(r.start_date, CURRENT_DATE()) > 0);

--Login
SELECT * FROM customer WHERE username = :username AND password = :password;
SELECT * FROM management WHERE username = :username AND password = :password;

--Registration
INSERT INTO customer VALUES (:username,:password,:email);

