package dao;


import classes.Curso;
import classes.Evento;
import static dao.Dao.getConnection;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.List;




public class EventosDao {
    public static int cadastrarEvento(String data, String hora){
       int status = 0;  
   try{
        Connection con = getConnection();
       PreparedStatement ps = (PreparedStatement) con.prepareStatement("INSERT INTO eventos(title, description, start, end, color, usuario_id) VALUES('Evento', 'Evento marcado', ?, ?, 'blue', 4)");
        Timestamp start = java.sql.Timestamp.valueOf(data + ' ' + hora);
        Timestamp end = new Timestamp(start.getTime()+2400000);  
        ps.setTimestamp(1, start);
        ps.setTimestamp(2, end);        
        status = ps.executeUpdate();
    }catch(Exception erro){
        System.out.println(erro);
    }      
       return status;
   }        
    public static List<Evento> getEventos(){
     List<Evento> list = new ArrayList<Evento>();
   try{
        Connection con = getConnection();
       PreparedStatement ps = (PreparedStatement) con.prepareStatement("select * from eventos");        
                    ResultSet rs = ps.executeQuery(); 

            while(rs.next()){
                Evento evento = new Evento();
                evento.setId(rs.getInt("id"));
                evento.setTitle(rs.getString("title"));
                evento.setDescription(rs.getString("description"));
                evento.setStart(rs.getTimestamp("start"));
                evento.setEnd(rs.getTimestamp("end"));                
                evento.setColor(rs.getString("color"));  
                evento.setCategoria_idCategoria(rs.getInt("categoria_idcategoria"));
                list.add(evento);
            }
    }catch(Exception erro){
        System.out.println(erro);
    }      
       return list;
   }
    
     public static List<Evento> getRelatorio() {
    List<Evento> list = new ArrayList<Evento>();
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT * FROM evento");
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            Evento evento = new Evento();
            evento.setId(rs.getInt("id"));
            evento.setTitle(rs.getString("title"));
            evento.setCategoria_idCategoria(rs.getInt("categoria_idcategoria"));
         
            list.add(evento);
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
            PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS contagem FROM evento");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                contagem = rs.getInt("contagem");
            }   
        }catch(Exception erro){
            System.out.println(erro);
        }
        return contagem;
    }
    
    public static int[] getRelatorioEvento() {

        int[] valores = {0, 0, 0, 0, 0, 0, 0};
        
        try{
            Connection con = getConnection();
            PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Festivaloushow FROM evento where Categoria_idCategoria = '5'");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                valores[0] = rs.getInt("Festivaloushow");
            }   
 
            ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Passeiooutour FROM evento where Categoria_idCategoria = '6'");
            rs = ps.executeQuery();
            while(rs.next()){
                valores[1] = rs.getInt("Passeiooutour");
            }         
            
             ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Gastronomia FROM evento where Categoria_idCategoria = '7'");
            rs = ps.executeQuery();
            while(rs.next()){
                valores[2] = rs.getInt("Gastronomia");
            }            
            
               ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Cursoouworkshop FROM evento where Categoria_idCategoria = '8'");
            rs = ps.executeQuery();
            while(rs.next()){
                valores[3] = rs.getInt("Cursoouworkshop");
            }            
            
              ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Congressooupalestra FROM evento where Categoria_idCategoria = '9'");
            rs = ps.executeQuery();
            while(rs.next()){
                valores[4] = rs.getInt("Congressooupalestra");
            }            
            
            ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Feiraouexposição FROM evento where Categoria_idCategoria = '10'");
            rs = ps.executeQuery();
            while(rs.next()){
                valores[5] = rs.getInt("Feiraouexposição");
            }       
            
             ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Outro FROM evento where Categoria_idCategoria = '11'");
            rs = ps.executeQuery();
            while(rs.next()){
                valores[6] = rs.getInt("Outro");
            }       
            
        }catch(Exception erro){
            System.out.println(erro);
        }
        return valores;
        
    }
}

