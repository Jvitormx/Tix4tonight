<%@page import="org.quartz.CronExpression"%>
<%@page import="org.quartz.impl.StdSchedulerFactory"%>
<%@page import="org.quartz.Scheduler"%>
<%@page import="org.quartz.TriggerBuilder"%>
<%@page import="org.quartz.Trigger"%>
<%@page import="org.quartz.JobBuilder"%>
<%@page import="org.quartz.CronScheduleBuilder"%>
<%@page import="classes.Job2"%>
<%@page import="classes.Job2"%>
<%@page import="org.quartz.JobDetail"%>
<%@page import="org.quartz.JobDetail"%>
<%@page import="classes.Job1"%>
<%@ page import = "java.util.Properties, javax.mail.*, 
javax.mail.internet.*, javax.activation.*, 
java.io.*, javax.servlet.*, javax.servlet.http.*" %>
<%
try {
JobDetail job1 = JobBuilder.newJob(Job1.class)
					.withIdentity("job1", "group1").build();

			Trigger trigger1 = TriggerBuilder.newTrigger()
					.withIdentity("cronTrigger1", "group1")
					.withSchedule(CronScheduleBuilder.cronSchedule("0/30 * * * * ?"))
					.build();
			
			Scheduler scheduler1 = new StdSchedulerFactory().getScheduler();
			scheduler1.start();
			scheduler1.scheduleJob(job1, trigger1);

			JobDetail job2 = JobBuilder.newJob(Job2.class)
					.withIdentity("job2", "group2").build();
			
			Trigger trigger2 = TriggerBuilder.newTrigger()
					.withIdentity("cronTrigger2", "group2")
					.withSchedule(CronScheduleBuilder.cronSchedule(new CronExpression("0/45 * * * * ?")))
					.build();
			
			Scheduler scheduler2 = new StdSchedulerFactory().getScheduler();
			scheduler2.start();
			scheduler2.scheduleJob(job2, trigger2);
			
			Thread.sleep(100000);
			
			scheduler1.shutdown();
			scheduler2.shutdown();
			
		} catch (Exception e) {
			e.printStackTrace();
		}
%>