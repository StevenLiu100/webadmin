-- --------------------------------------------------------
-- 插入测试数据
-- 插入测试数据前请重新运行webiddb.sql


delete from unit;
insert into unit(unitname,parentid,unitorder) values('一级单位1',0,0);
insert into unit(unitname,parentid,unitorder) values('一级单位2',0,1);
insert into unit(unitname,parentid,unitorder) values('一级单位3',0,2);
insert into unit(unitname,parentid,unitorder) values('二级单位1',1,0);
insert into unit(unitname,parentid,unitorder) values('二级单位2',1,1);
insert into unit(unitname,parentid,unitorder) values('二级单位3',1,2);


delete from webinfo;
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('网站名称','网站类型','网站编号',3,5,'网站单位','网站审批单位','新闻#软件#影视','21.11.12.11','www.sohu.com','2012-01-02 10:11:12','未注册');
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('网站名称1','网站类型1','网站编号1',3,5,'网站单位1','网站审批单位1','新闻#软件#影视1','21.11.12.11#21.10.13.8','www.sohu1.com','2012-02-12 10:11:12','未注册');
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('网站名称2','网站类型2','网站编号2',3,6,'网站单位2','网站审批单位2','新闻#软件#影视2','21.11.12.11','www.sohu2.com','2012-03-01 10:11:12','申请中');
insert into webinfo(webname,webtype,webnumber,firstlevelid,secondlevelid,webunit,webauthorize,webchanel,webip,webdomain,webrecorddate,webstate)
values('网站名称3','网站类型3','网站编号3',3,6,'网站单位3','网站审批单位3','新闻#软件#影视3','21.11.12.11','www.sohu3.com','2012-03-02 10:11:12','已注册');

delete from webhistory;
insert into webhistory(webid,checkname,createdate,checkconnect,checkwebnumber,checkunit,checkip,checkdomain,checklinkman,checktel,checkregister)
values(1,'2012年度检查','2012-03-02 10:11:12','通','无','无','错误','无','无','无',false);
insert into webhistory(webid,checkname,createdate,checkconnect,checkwebnumber,checkunit,checkip,checkdomain,checklinkman,checktel,checkregister)
values(1,'2012年3月检查','2012-03-12 10:11:12','通','无','无','错误','无','无','无',false);
insert into webhistory(webid,checkname,createdate,checkconnect,checkwebnumber,checkunit,checkip,checkdomain,checklinkman,checktel,checkregister)
values(2,'2012年3月检查','2012-03-12 10:11:12','通','错误','正确','错误','无','无','无',true);



delete from ACApplication;
insert into ACApplication(applicationname,description,enable) values('系统名称1','系统说明1',true);
insert into ACApplication(applicationname,description,enable) values('备案名称2','系统说明2',true);
insert into ACApplication(applicationname,description,enable) values('备案名称3','系统说明3',true);
insert into ACApplication(applicationname,description,enable) values('备案名称4','系统说明4',false);

delete from ACUser;
insert into ACUser(username,email,password,passwordsalt,mobile,tel,unit,createdate,userstyle,state,comment) values('张三','e2@email.com','111111','salt','18901390000','12345678','单位1','2012-01-02 10:11:12',1,'可用','备注1');
insert into ACUser(username,email,password,passwordsalt,mobile,tel,unit,createdate,userstyle,state,comment) values('李四','e2@email.com','111111','salt','18901390000,13901110111','12345678,010-22222222','单位2','2012-02-22 8:11:12',2,'可用','备注2');
insert into ACUser(username,email,password,passwordsalt,mobile,tel,unit,createdate,userstyle,state,comment) values('王五','e3@email.com','111111','salt','18901391111','12345678,010-22222222,2222222','单位3','2012-02-22 8:11:12',3,'禁用','备注3');

delete from SYSLog;
insert into SYSLog(userid,event,eventtype,createdate) values(1,'登录系统','系统','2012-01-02 10:11:12');
insert into SYSLog(userid,event,eventtype,createdate) values(1,'退出系统','系统','2012-01-02 12:01:00');
insert into SYSLog(userid,event,eventtype,createdate) values(2,'修改记录','业务','2012-03-12 10:11:12');


delete from webcert;
insert into webcert(webid,releaseunit,releasedate,releaseuserid,validity)
values(1,'发放单位','2012-03-12 10:11:12',1,'2013-03-12 10:11:12');
insert into webcert(webid,releaseunit,releasedate,releaseuserid,validity)
values(2,'发放单位1','2012-04-12 10:11:12',2,'2013-04-12 10:11:12');
insert into webcert(webid,releaseunit,releasedate,releaseuserid,validity)
values(3,'发放单位3','2012-04-12 10:11:12',2,'2013-04-12 10:11:12');

delete from webcheck;
insert into webcheck(webid,checkuserid,checkdate,suggestion,ifpass)
values(1,2,'2012-04-12 10:11:12','联系电话不正确',false);
insert into webcheck(webid,checkuserid,checkdate,suggestion,ifpass)
values(2,2,'2012-04-12 10:11:12','',true);

delete from webillegal;
insert into webillegal(reporttype,reportdate,reporter,reportertel,weburl,reportcontent,iftrue,dealresult,dealuserid)
values('举报','2012-04-12 10:11:12','举报人','88886666','http://www.cc./ss/dd','内容违规',true,'已通知对方',1);
insert into webillegal(reporttype,reportdate,reporter,reportertel,weburl,reportcontent,iftrue,dealresult,dealuserid)
values('举报','2012-05-12 10:11:12','举报人1','89996666','http://www.cc./ss/dd','内容违规',true,'已通知对方',2);
insert into webillegal(reporttype,reportdate,reporter,reportertel,weburl,reportcontent,iftrue,dealresult,dealuserid)
values('自查','2012-05-12 10:11:12','','','http://www.cc./ss/dd','内容违规',true,'已通知对方',2);