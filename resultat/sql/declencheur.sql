use
vds;
drop trigger if exists avantAjoutCourse;
drop trigger if exists apresSuppressionResultat;
drop trigger if exists apresAjoutResultat;
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
   set new.nbParticipant = 0;
end if;

end
$$

create trigger apresAjoutResultat
    after insert
    on resultat
    for each row
    update course
    set nbParticipant = nbParticipant + 1
    where course.id = new.idCourse;
$$

create trigger apresSuppressionResultat
    after delete
    on resultat
    for each row
    update course
    set nbParticipant = nbParticipant - 1
    where course.id = old.idCourse;
$$