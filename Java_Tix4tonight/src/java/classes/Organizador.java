package classes;

/**
 *
 * @author aluno
 */
public class Organizador {
    private int idOrganizador;
    private String nome;
    private String email;
    private String senha;
    private String acesso;
    private String status;

    public int getidOrganizador() {
        return idOrganizador;
    }

    public void setidOrganizador(int idOrganizador) {
        this.idOrganizador = idOrganizador;
    }

    public String getnome() {
        return nome;
    }

    public void setnome(String nome) {
        this.nome = nome;
    }

    public String getemail() {
        return email;
    }

    public void setemail(String email) {
        this.email = email;
    }

    public String getsenha() {
        return senha;
    }

    public void setsenha(String senha) {
        this.senha = senha;
    }

    public String getacesso() {
        return acesso;
    }

    public void setacesso(String acesso) {
        this.acesso = acesso;
    }
    
    public String getstatus() {
        return status;
    }

    public void setstatus(String status) {
        this.status = status;
    }
    
}
