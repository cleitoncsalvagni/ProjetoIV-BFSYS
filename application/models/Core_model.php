<?php

defined('BASEPATH') or exit('Ação não permitida');

class Core_model extends CI_Model
{

    public function get_all($table = NULL, $condition = NULL)
    {

        if ($table && $this->db->table_exists($table)) {

            if (is_array($condition)) {

                $this->db->where($condition);
            }

            return $this->db->get($table)->result();
        } else {
            return FALSE;
        }
    }

    public function get_by_id($table = NULL, $condition = NULL)
    {

        if ($table && $this->db->table_exists($table) && is_array($condition)) {

            $this->db->where($condition);
            $this->db->limit(1);

            return $this->db->get($table)->row();
        } else {
            return FALSE;
        }
    }

    public function insert($table = NULL, $data = NULL, $get_last_id = NULL)
    {

        if ($table && $this->db->table_exists($table) && is_array($data)) {

            $this->db->insert($table, $data);

            if ($get_last_id) {
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Dados salvos com sucesso');
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível salvar os dados');
            }
        } else {
            return FALSE;
        }
    }

    public function update($table = NULL, $data = NULL, $condition = NULL)
    {

        if ($table && $this->db->table_exists($table) && is_array($data) && is_array($condition)) {

            if ($this->db->update($table, $data, $condition)) {
                $this->session->set_flashdata('success', 'Dados salvos com sucesso');
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível salvar os dados');
            }
        } else {
            return FALSE;
        }
    }

    public function delete($table = NULL, $condition = NULL)
    {

        $this->db->db_debug = FALSE;

        if ($table && $this->db->table_exists($table) && is_array($condition)) {

            $status = $this->db->delete($table, $condition);

            $error = $this->db->error();

            if (!$status) {
                foreach ($error as $code) {
                    if ($code == 1451) {
                        $this->session->set_flashdata('erro', 'Esse registro não pode ser excluído, pois está sendo utilizado em outra tabela');
                    }
                }
            } else {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso');
            }

            $this->db->db_debug = TRUE;
        } else {
            return FALSE;
        }
    }

    /** Generate Unique Code
     
     * @ Habilitar helper string
     * @param string $table
     * @param string $type_of_code. Ex.: 'numeric', 'alpha', 'alnum', 'basic', 'numeric', 'nozero', 'md5', 'sha1'
     * @param int $size_of_code
     * @param string $field_seach
     * @return int
     
     **/

    public function generate_unique_code($table = NULL, $type_of_code = NULL, $size_of_code, $field_search)
    {

        do {
            $code = random_string($type_of_code, $size_of_code);
            $this->db->where($field_search, $code);
            $this->db->from($table);
        } while ($this->db->count_all_results() >= 1);

        return $code;
    }
}
