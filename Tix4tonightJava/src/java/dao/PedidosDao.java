/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import classes.Pedido;
import static dao.Dao.getConnection;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author Cheizx
 */
public class PedidosDao {
    
     public static List<Pedido> getRelatorio() {
    List<Pedido> list = new ArrayList<Pedido>();
    try{
        Connection con = getConnection();
        PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT * FROM pedido");
        ResultSet rs = ps.executeQuery();
        while(rs.next()){
            Pedido pedido = new Pedido();
            pedido.setId(rs.getInt("ID_pagamento"));
            pedido.setTitle(rs.getString("Status"));
         
            list.add(pedido);
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
            PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS contagem FROM pedido");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                contagem = rs.getInt("contagem");
            }   
        }catch(Exception erro){
            System.out.println(erro);
        }
        return contagem;
    }
    
    public static int[] getRelatorioPedido() {

        int[] valores = {0};
        
        try{
            Connection con = getConnection();
            PreparedStatement ps = (PreparedStatement) con.prepareStatement("SELECT count(*) AS Compras FROM pedido where Status = 'realizado'");
            ResultSet rs = ps.executeQuery();
            while(rs.next()){
                valores[0] = rs.getInt("Compras");
            }   
            
        }catch(Exception erro){
            System.out.println(erro);
        }
        return valores;
        
    }
    
}
