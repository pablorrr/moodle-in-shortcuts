<?php

public function insert_user_orgunit_id()
    {
        //odnajdz usera z najwyzszym id -ostatniego
        $sql = 'SELECT `id` FROM `mdl_user` WHERE `id` = (SELECT MAX(`id`) FROM `mdl_user`)';
        $user_id = $this->db->get_record_sql($sql);

        //zbierz wszytskie id z tabeli position
        $organizational_unit = $this->db->get_records('organizational_unit');

        //rewers  tablicy by id  buyly odpwiednio dopasowane
        $reversed_org = array_reverse($organizational_unit);
        //update kolumny
        foreach ($reversed_org as $unit_id) {

            $user = new stdClass();
            $user->id = $user_id->id;
            $user->organizational_unit_id = $unit_id->id;

            $this->db->update_record('user', $user);
            $user_id->id--;
        }

    }
	//////////////////////////////////////////////
	 $this->db->insert_records('organizational_unit', $organizational_unit_object_arr_param);