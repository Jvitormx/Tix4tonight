/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package testes;

import dao.EventosDao;
import java.sql.Date;

/**
 *
 * @author abriv
 */
public class Teste {
    public static void main(String[] args) {  
            EventosDao.cadastrarEvento("2022-07-18", "09:00:00");
    }
}
