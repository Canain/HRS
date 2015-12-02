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

--View Review
SELECT rating, comment FROM review WHERE location = :location;

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

--Cancel Reservation
SELECT total_cost, is_cancelled FROM reservation WHERE reservation_id = :id;
            UPDATE reservation SET is_cancelled = 1, total_cost =
            CASE WHEN datediff(start_date, current_date()) > 3 THEN 0
            WHEN datediff(start_date, current_date()) > 1 THEN total_cost / 5
            ELSE total_cost END WHERE reservation_id = :id AND is_cancelled = 0;

SELECT total_cost FROM reservation WHERE reservation_id = :id AND is_cancelled = 1;

--Search Rooms
SELECT
  *
FROM
  room
WHERE
  location = :location
  AND num NOT IN (SELECT
                    r.num
                  FROM
                    room AS r,
                    reservation AS rs,
                    reservation_has_room AS rhr
                  WHERE
                    r.num = rhr.room_no
                    AND rs.reservation_id = rhr.reservation_id
                    AND is_cancelled = 0
                    AND rhr.location = :location
                    AND ((DATE(start_date) >= :start_date AND DATE(end_date) <= :start_date)
                         OR (DATE(start_date) <= :end_date AND DATE(end_date) >= :end_date)
                         OR (DATE(start_date) >= :start_date AND DATE(end_date) <= :end_date)));

--Make Reservation
INSERT INTO reservation VALUES (DEFAULT, :start_date, :end_date, false, :total_cost, :card_no, :username);
INSERT INTO reservation_has_room VALUES (:reservation_id, :location, :room_no, :extra_bed);

--Find Reservation
SELECT * FROM reservation WHERE reservation_id = :reservation_id AND username = :username AND is_cancelled = 0;

--Find Rooms For Reservation
SELECT reservation_id, reservation_has_room.location as location, num, extra_bed, cost, category, people, cost_extra_bed
FROM reservation_has_room, room WHERE num = room_no AND reservation_id = :reservation_id;

--Search Room Update Availability
SELECT
  (SELECT
     COUNT(*)
   FROM
     room AS ro,
     reservation_has_room AS hr
   WHERE
     hr.location = :location
     AND ro.num = hr.room_no
     AND hr.reservation_id = :reservation_id
     AND num NOT IN (SELECT
                       r.num
                     FROM
                       room AS r,
                       reservation AS rs,
                       reservation_has_room AS rhr
                     WHERE
                       r.num = rhr.room_no
                       AND rhr.location = :location
                       AND rs.reservation_id != :reservation_id
                       AND rs.reservation_id = rhr.reservation_id
                       AND is_cancelled = 0
                       AND ((DATE(start_date) <= :new_start_date AND DATE(end_date) >= :new_start_date)
                            OR (DATE(start_date) <= :new_end_date AND DATE(end_date) >= :new_end_date)
                            OR (DATE(start_date) >= :new_start_date AND DATE(end_date) <= :new_end_date)))) -
  (SELECT
     COUNT(*)
   FROM
     reservation_has_room
   WHERE
     reservation_id = :reservation_id)
FROM DUAL;

--Update Reservation
UPDATE reservation SET start_date = :new_start_date, end_date = :new_end_date WHERE reservation_id = :reservation_id;
