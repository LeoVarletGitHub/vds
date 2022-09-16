use
vds;
drop trigger if exists avantAjoutCourse;

delimiter
$$
create trigger avantAjoutCourse
    before insert
    on course
    for each row
begin
    if exists (select 1 from course where date = new.date AND saison = new.saison AND distance = new.distance) then
  SIGNAL sqlstate '45000' set message_text = 'Cette course existe déjà';

end if;

if
new.nbParticipant != 0 then
   SIGNAL sqlstate '45000' set message_text = 'Le champ nbParticipant doit être mis a 0 à l''ajout';
end if;
end
$$