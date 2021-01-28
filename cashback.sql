create table intellikit(
rulename varchar(300) not null,
oncoupon varchar(300) ,
outcoupon varchar(300),
validitydays int,
percentage decimal(12,7),
maxamount decimal(12,7) ,
minimumpurchase decimal(12,7),
intellikit3monthssubscr int,
intellikit3monthssubscrisactive int default 0,
intellikit6monthssubscr int,
intellikit6monthssubscrisactive int default 0,
intellikit9monthssubscr int,
intellikit9monthssubscrisactive int default 0,
intellikit12monthssubscr int,
intellikit12monthssubscrisactive int default 0,
emailtempalateid decimal(12,1),
startdate datetime,
enddate datetime,
isactive int default 0,
couponcodition boolean default true,
createby varchar(500),
createdate datetime ,
modifiedby varchar(500)  ,
modifieddate datetime 
);

rename table intellikit to intellikitcashback;

alter table intellikitcashback add column intellikitcashabackid int primary key AUTO_INCREMENT;

alter TABLE `intellikitcashback` modify column intellikitcashabackid int FIRST;

alter table `users` add isactive int default 0;

alter table `users` add logindate date;

ALTER TABLE `intellikitcashback` DROP `couponcodition`;

create table sessioncountry (
countryid int PRIMARY key AUTO_INCREMENT,
countrycode varchar(10),
sessionstarted datetime,
createddate datetime   
);

ALTER TABLE `sessioncountry` CHANGE `countryid` `scountryid` INT(11) NOT NULL AUTO_INCREMENT;

alter table `intellikitcashback` modify intellikitcashabackid int AUTO_INCREMENT;


