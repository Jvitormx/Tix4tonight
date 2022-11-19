/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import classes.Cliente;
import static dao.Dao.getConnection;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author aluno
 */
public class ClienteDao {
        public static Cliente getClienteById(int idCliente){
        Cliente cliente = null;      
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("select * from cliente where idCliente=?");
        ps.setInt(1, idCliente);
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            cliente = new Cliente();
            cliente.setidCliente(rs.getInt("idCliente"));
            cliente.setnome(rs.getString("nome"));
            cliente.setemail(rs.getString("email"));         
            cliente.setsenha(rs.getString("senha"));   
            cliente.setacesso(rs.getString("acesso")); 
        }
    }catch(Exception erro){
        System.out.println(erro);
    }      
        return cliente;
    }
    
    
   public static int editarCliente(Cliente cliente){
       int status = 0;  
   try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("UPDATE cliente SET nome=?, email=?, acesso=? WHERE idCliente=?");
        ps.setString(1, cliente.getnome());
        ps.setString(2, cliente.getemail());
        ps.setString(3, cliente.getacesso()); 
        ps.setInt(4, cliente.getidCliente());         
        status = ps.executeUpdate();
    }catch(Exception erro){
        System.out.println(erro);
    }      
       return status;
   }
    
    public static List<Cliente> getCliente(int inicio, int total) {
    List<Cliente> list = new ArrayList<Cliente>();
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT * FROM cliente ORDER BY idCliente LIMIT " + (inicio - 1) + " ," + total);
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            Cliente cliente = new Cliente();
            cliente.setidCliente(rs.getInt("idCliente"));
            cliente.setnome(rs.getString("nome"));
            cliente.setemail(rs.getString("email"));         
            cliente.setsenha(rs.getString("senha"));   
            cliente.setacesso(rs.getString("acesso")); 
            cliente.setstatus(rs.getString("status"));
            list.add(cliente);
        }       
    }catch(Exception erro){
        System.out.println(erro);
    }
    return list;
    }

    public static List<Cliente> getRelatorio() {
    List<Cliente> list = new ArrayList<Cliente>();
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT * FROM cliente");
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            Cliente cliente = new Cliente();
            cliente.setidCliente(rs.getInt("idCliente"));
            cliente.setnome(rs.getString("nome"));
            cliente.setemail(rs.getString("email"));          
            cliente.setacesso(rs.getString("acesso")); 
            list.add(cliente);
        }       
    }catch(Exception erro){
        System.out.println(erro);
    }
    return list;
    }
    
    public static int getContagem() {
        int contagem = 0;
        try{
            Connection con = getConnection();
            PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS contagem FROM cliente");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                contagem = rs.getInt("contagem");
            }   
        }catch(Exception erro){
            System.out.println(erro);
        }
        return contagem;
    }
    
    
        public static int[] getRelatorioCliente() {

        int[] valores = {0, 0};
        
        try{
            Connection con = getConnection();
            PreparedStatement  ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Comum FROM cliente where acesso = 'Comum'");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                valores[1] = rs.getInt("Comum");
            }            
 
              
            
        }catch(Exception erro){
            System.out.println(erro);
        }
        return valores;
    }
        

        
    
    public static int excluirCliente(Cliente cliente){
       int status = 0;  
        try{
             Connection con = getConnection();
             PreparedStatement ps = (PreparedStatement) con.prepareStatement("DELETE FROM cliente WHERE idCliente=?");
             ps.setInt(1, cliente.getidCliente());         
             status = ps.executeUpdate();
         }catch(Exception erro){
             System.out.println(erro);
         }      
            return status;
   }
    

    public static int bloquearCliente(Cliente cliente){
       int status = 0;  
       String statusdocliente;
       
       if(cliente.getstatus().equals("ativo")){
        statusdocliente = "inativo";   
       }else{
        statusdocliente = "ativo";   
       }
        try{
             Connection con = getConnection();
             PreparedStatement ps = (PreparedStatement) con.prepareStatement("UPDATE cliente SET status=? WHERE idCliente=?");
             ps.setString(1, statusdocliente);
             ps.setInt(2, cliente.getidCliente());         
             status = ps.executeUpdate();
         }catch(Exception erro){
             System.out.println(erro);
         }      
            return status;
   }

    
   public static int cadastrarCliente(Cliente cliente){
       int status = 0;  
   try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("INSERT INTO CLIENTE(NOME,EMAIL,SENHA,ACESSO,STATUS) VALUES(?,?,?,?,'ativo')");
        ps.setString(1, cliente.getnome());
        ps.setString(2, cliente.getemail());
        ps.setString(3, cliente.getsenha());        
        ps.setString(4, cliente.getacesso());          
        status = ps.executeUpdate();
    }catch(Exception erro){
        System.out.println(erro);
    }      
       return status;
   }
    
public static Cliente logar(String email, String senha){ 
Cliente cliente = new Cliente();    
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("select * from cliente where email=?");
        ps.setString(1, email);
        ResultSet rs = ps.executeQuery();
        //Verifica se a consulta retornou resultado
        if (rs.next()) {       
                if(rs.getString("status").equals("ativo")){
                    if(rs.getString("senha").equals(senha)){
                        cliente.setidCliente(rs.getInt("idCliente"));
                        cliente.setnome(rs.getString("nome"));
                        cliente.setemail(rs.getString("email"));         
                        cliente.setsenha(rs.getString("senha"));   
                        cliente.setacesso(rs.getString("acesso"));     
                    }else{
                        //Senha errada
                        cliente = null;
                    }
                }else{
                   //Usuário Inativo
                   cliente = null;     
                }
        }else{
            // E-mail não existe
            cliente = null; 
        }
    }catch(Exception erro){
        System.out.println(erro);
    }      
        return cliente;
    }
   
}
