-- --------------------------------------------------------
-- �����������
-- �����������ǰ����������webiddb.sql


delete from unit;
insert into unit(unitname,parentid,unitorder) values('һ����λ1',0,0);
insert into unit(unitname,parentid,unitorder) values('һ����λ2',0,1);
insert into unit(unitname,parentid,unitorder) values('һ����λ3',0,2);
insert into unit(unitname,parentid,unitorder) values('������λ1',1,0);
insert into unit(unitname,parentid,unitorder) values('������λ2',1,1);
insert into unit(unitname,parentid,unitorder) values('������λ3',1,2);


delete from webinfo;
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('��վ����','��վ����','��վ���',3,5,'��վ��λ','��վ������λ','����#���#Ӱ��','21.11.12.11','www.sohu.com','2012-01-02 10:11:12','δע��');
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('��վ����1','��վ����1','��վ���1',3,5,'��վ��λ1','��վ������λ1','����#���#Ӱ��1','21.11.12.11#21.10.13.8','www.sohu1.com','2012-02-12 10:11:12','δע��');
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('��վ����2','��վ����2','��վ���2',3,6,'��վ��λ2','��վ������λ2','����#���#Ӱ��2','21.11.12.11','www.sohu2.com','2012-03-01 10:11:12','������');
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('��վ����3','��վ����3','��վ���3',3,6,'��վ��λ3','��վ������λ3','����#���#Ӱ��3','21.11.12.11','www.sohu3.com','2012-03-02 10:11:12','��ע��');

delete from webhistory;
insert into webhistory(webid,checkname,createdate,checkconnect,checkwebnumber,checkunit,checkip,checkdomain,checklinkman,checktel,checkregister)
values(1,'2012��ȼ��','2012-03-02 10:11:12','ͨ','��','��','����','��','��','��',false);
insert into webhistory(webid,checkname,createdate,checkconnect,checkwebnumber,checkunit,checkip,checkdomain,checklinkman,checktel,checkregister)
values(1,'2012��3�¼��','2012-03-12 10:11:12','ͨ','��','��','����','��','��','��',false);
insert into webhistory(webid,checkname,createdate,checkconnect,checkwebnumber,checkunit,checkip,checkdomain,checklinkman,checktel,checkregister)
values(2,'2012��3�¼��','2012-03-12 10:11:12','ͨ','����','��ȷ','����','��','��','��',true);



delete from ACApplication;
insert into ACApplication(applicationname,description,enable) values('ϵͳ����1','ϵͳ˵��1',true);
insert into ACApplication(applicationname,description,enable) values('��������2','ϵͳ˵��2',true);
insert into ACApplication(applicationname,description,enable) values('��������3','ϵͳ˵��3',true);
insert into ACApplication(applicationname,description,enable) values('��������4','ϵͳ˵��4',false);

delete from ACUser;
insert into ACUser(username,email,password,passwordsalt,mobile,tel,unit,createdate,userstyle,state,comment) values('����','e2@email.com','111111','salt','18901390000','12345678','��λ1','2012-01-02 10:11:12',1,'����','��ע1');
insert into ACUser(username,email,password,passwordsalt,mobile,tel,unit,createdate,userstyle,state,comment) values('����','e2@email.com','111111','salt','18901390000,13901110111','12345678,010-22222222','��λ2','2012-02-22 8:11:12',2,'����','��ע2');
insert into ACUser(username,email,password,passwordsalt,mobile,tel,unit,createdate,userstyle,state,comment) values('����','e3@email.com','111111','salt','18901391111','12345678,010-22222222,2222222','��λ3','2012-02-22 8:11:12',3,'����','��ע3');

delete from SYSLog;
insert into SYSLog(userid,event,eventtype,createdate) values(1,'��¼ϵͳ','ϵͳ','2012-01-02 10:11:12');
insert into SYSLog(userid,event,eventtype,createdate) values(1,'�˳�ϵͳ','ϵͳ','2012-01-02 12:01:00');
insert into SYSLog(userid,event,eventtype,createdate) values(2,'�޸ļ�¼','ҵ��','2012-03-12 10:11:12');


delete from webcert;
insert into webcert(webid,releaseunit,releasedate,releaseuserid,validity)
values(1,'���ŵ�λ','2012-03-12 10:11:12',1,'2013-03-12 10:11:12');
insert into webcert(webid,releaseunit,releasedate,releaseuserid,validity)
values(2,'���ŵ�λ1','2012-04-12 10:11:12',2,'2013-04-12 10:11:12');
insert into webcert(webid,releaseunit,releasedate,releaseuserid,validity)
values(3,'���ŵ�λ3','2012-04-12 10:11:12',2,'2013-04-12 10:11:12');

delete from webcheck;
insert into webcheck(webid,checkuserid,checkdate,suggestion,ifpass)
values(1,2,'2012-04-12 10:11:12','��ϵ�绰����ȷ',false);
insert into webcheck(webid,checkuserid,checkdate,suggestion,ifpass)
values(2,2,'2012-04-12 10:11:12','',true);

delete from webillegal;
insert into webillegal(reporttype,reportdate,reporter,reportertel,weburl,reportcontent,iftrue,dealresult,dealuserid)
values('�ٱ�','2012-04-12 10:11:12','�ٱ���','88886666','http://www.cc./ss/dd','����Υ��',true,'��֪ͨ�Է�',1);
insert into webillegal(reporttype,reportdate,reporter,reportertel,weburl,reportcontent,iftrue,dealresult,dealuserid)
values('�ٱ�','2012-05-12 10:11:12','�ٱ���1','89996666','http://www.cc./ss/dd','����Υ��',true,'��֪ͨ�Է�',2);
insert into webillegal(reporttype,reportdate,reporter,reportertel,weburl,reportcontent,iftrue,dealresult,dealuserid)
values('�Բ�','2012-05-12 10:11:12','','','http://www.cc./ss/dd','����Υ��',true,'��֪ͨ�Է�',2);