<%@ page import="dao.Dao, dao.ClienteDao"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<jsp:useBean id="u" class="classes.Cliente"></jsp:useBean>
<jsp:setProperty property="*" name="u" />

<%@include file="acessoadm.jsp"%>

<%
    int i = ClienteDao.cadastrarCliente(u);
    
    if(i>0){
        response.sendRedirect("clientecontrolar.jsp?pag=1");
    }else{
        response.sendRedirect("clientecadastrar-erro.jsp");        
    }
%>