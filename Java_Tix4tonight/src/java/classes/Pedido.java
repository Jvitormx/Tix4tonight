package classes;

import java.sql.Timestamp;

/**
 *
 * @author abriv
 */
public class Pedido {
    private int ID_pagamento;
    private String Status;
    
    public int getId() {
        return ID_pagamento;
    }

    public void setId(int ID_pagamento) {
        this.ID_pagamento = ID_pagamento;
    }

    public String getTitle() {
        return Status;
    }

    public void setTitle(String Status) {
        this.Status = Status;
    }

}