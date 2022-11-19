package dao;

import classes.Organizador;
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
public class OrganizadorDao {
        public static Organizador getOrganizadorById(int idOrganizador){
        Organizador organizador = null;      
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("select * from organizador where idOrganizador=?");
        ps.setInt(1, idOrganizador);
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            organizador = new Organizador();
            organizador.setidOrganizador(rs.getInt("idOrganizador"));
            organizador.setnome(rs.getString("nome"));
            organizador.setemail(rs.getString("email"));         
            organizador.setsenha(rs.getString("senha"));   
            organizador.setacesso(rs.getString("acesso")); 
        }
    }catch(Exception erro){
        System.out.println(erro);
    }      
        return organizador;
    }
    
    
   public static int editarOrganizador(Organizador organizador){
       int status = 0;  
   try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("UPDATE organizador SET nome=?, email=?, acesso=? WHERE idOrganizador=?");
        ps.setString(1, organizador.getnome());
        ps.setString(2, organizador.getemail());
        ps.setString(3, organizador.getacesso()); 
        ps.setInt(4, organizador.getidOrganizador());         
        status = ps.executeUpdate();
    }catch(Exception erro){
        System.out.println(erro);
    }      
       return status;
   }
    
    public static List<Organizador> getOrganizador(int inicio, int total) {
    List<Organizador> list = new ArrayList<Organizador>();
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT * FROM organizador ORDER BY idOrganizador LIMIT " + (inicio - 1) + " ," + total);
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            Organizador organizador = new Organizador();
            organizador.setidOrganizador(rs.getInt("idOrganizador"));
            organizador.setnome(rs.getString("nome"));
            organizador.setemail(rs.getString("email"));         
            organizador.setsenha(rs.getString("senha"));   
            organizador.setacesso(rs.getString("acesso")); 
            organizador.setstatus(rs.getString("status"));
            list.add(organizador);
        }       
    }catch(Exception erro){
        System.out.println(erro);
    }
    return list;
    }

    public static List<Organizador> getRelatorio() {
    List<Organizador> list = new ArrayList<Organizador>();
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT * FROM organizador");
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            Organizador organizador = new Organizador();
            organizador.setidOrganizador(rs.getInt("idOrganizador"));
            organizador.setnome(rs.getString("nome"));
            organizador.setemail(rs.getString("email"));          
            organizador.setacesso(rs.getString("acesso")); 
            list.add(organizador);
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
            PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS contagem FROM organizador");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                contagem = rs.getInt("contagem");
            }   
        }catch(Exception erro){
            System.out.println(erro);
        }
        return contagem;
    }
    
    
        public static int[] getRelatorioOrganizador() {

        int[] valores2 = {0, 0};
        
        try{
            Connection con = getConnection();
            PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Organizador FROM organizador where acesso = 'Org'");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                valores2[0] = rs.getInt("Organizador");
            }   
   
            
        }catch(Exception erro){
            System.out.println(erro);
        }
        return valores2;
    }
        

        
    
    public static int excluirOrganizador(Organizador organizador){
       int status = 0;  
        try{
             Connection con = getConnection();
             PreparedStatement ps = (PreparedStatement) con.prepareStatement("DELETE FROM organizador WHERE idOrganizador=?");
             ps.setInt(1, organizador.getidOrganizador());         
             status = ps.executeUpdate();
         }catch(Exception erro){
             System.out.println(erro);
         }      
            return status;
   }
    

    public static int bloquearOrganizador(Organizador organizador){
       int status = 0;  
       String statusdoorganizador;
       
       if(organizador.getstatus().equals("ativo")){
        statusdoorganizador = "inativo";   
       }else{
        statusdoorganizador = "ativo";   
       }
        try{
             Connection con = getConnection();
             PreparedStatement ps = (PreparedStatement) con.prepareStatement("UPDATE organizador SET status=? WHERE idOrganizador=?");
             ps.setString(1, statusdoorganizador);
             ps.setInt(2, organizador.getidOrganizador());         
             status = ps.executeUpdate();
         }catch(Exception erro){
             System.out.println(erro);
         }      
            return status;
   }

    
   public static int cadastrarOrganizador(Organizador organizador){
       int status = 0;  
   try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("INSERT INTO CLIENTE(NOME,EMAIL,SENHA,ACESSO,STATUS) VALUES(?,?,?,?,'ativo')");
        ps.setString(1, organizador.getnome());
        ps.setString(2, organizador.getemail());
        ps.setString(3, organizador.getsenha());        
        ps.setString(4, organizador.getacesso());          
        status = ps.executeUpdate();
    }catch(Exception erro){
        System.out.println(erro);
    }      
       return status;
   }
    
public static Organizador logar(String email, String senha){ 
Organizador organizador = new Organizador();    
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("select * from organizador where email=?");
        ps.setString(1, email);
        ResultSet rs = ps.executeQuery();
        //Verifica se a consulta retornou resultado
        if (rs.next()) {       
                if(rs.getString("status").equals("ativo")){
                    if(rs.getString("senha").equals(senha)){
                        organizador.setidOrganizador(rs.getInt("idOrganizador"));
                        organizador.setnome(rs.getString("nome"));
                        organizador.setemail(rs.getString("email"));         
                        organizador.setsenha(rs.getString("senha"));   
                        organizador.setacesso(rs.getString("acesso"));     
                    }else{
                        //Senha errada
                        organizador = null;
                    }
                }else{
                   //Usuário Inativo
                   organizador = null;     
                }
        }else{
            // E-mail não existe
            organizador = null; 
        }
    }catch(Exception erro){
        System.out.println(erro);
    }      
        return organizador;
    }
   
}
