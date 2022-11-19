<%@page import="classes.Cliente"%>
<%@ page import="dao.Dao, dao.ClienteDao"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<jsp:useBean id="u" class="classes.Cliente"></jsp:useBean>
<jsp:setProperty property="*" name="u" />
    
<%
    //Lê valores do formulário
    String email = request.getParameter("email");
    String senha = request.getParameter("senha");
    
    //Envia os valores para o Dao e recebe o resultado da consulta
    Cliente cliente = ClienteDao.logar(email, senha);
    
    //Verifica se algum usuário foi encontrado
    if(cliente!=null){
        //Cria sessão e redireciona para a tela principal
        request.getSession().setAttribute("cliente", cliente.getnome());
        request.getSession().setAttribute("acesso", cliente.getacesso());    
        response.sendRedirect("principal.jsp");
        
        //Redireciona erros para a tela de login
    }else{
        response.sendRedirect("index.jsp");
    }
%>