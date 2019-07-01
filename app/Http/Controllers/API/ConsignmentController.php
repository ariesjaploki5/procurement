<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Views\Consignment;
use DB;

class ConsignmentController extends Controller
{
    public function index(){

    }

    public function search($id){
        $data = Consignment::where('supplier_id', $id)->orderBy('gendesc')->get();

        // $data = DB::SELECT("SELECT dps.id AS dps_id, dps.dmd_id, dps.price_schedule_id, dps.supplier_id, dps.bid_price, dps.packaging_id, dps.manufacturer_id, dps.brand_id, dps.country_id, dps.rank, dps.terminated, s.supplier_name, s.supplier_address, 
        //     m.manufacturer_desc, b.brand_desc, p.packaging_desc, c.country_desc, ps.price_schedule_year, dmd.dmdcomb, dmd.dmdctr, dmd.dmd_id AS Expr1, dmd.ssl, homis_dmd.stredesc, homis_dmd.rtedesc, homis_dmd.formdesc, 
        //     homis_dmd.gendesc, homis_dmd.brandname, homis_dmd.dmdnost, homis_dmd.dmdctr AS Expr2, homis_dmd.dmdcomb AS Expr3
        //     FROM dbo.dmd_price_schedule AS dps INNER JOIN
        //     dbo.suppliers AS s ON dps.supplier_id = s.supplier_id INNER JOIN
        //     dbo.manufacturers AS m ON dps.manufacturer_id = m.manufacturer_id INNER JOIN
        //     dbo.brands AS b ON dps.brand_id = b.brand_id INNER JOIN
        //     dbo.packagings AS p ON dps.packaging_id = p.packaging_id INNER JOIN
        //     dbo.countries AS c ON dps.country_id = c.country_id INNER JOIN
        //     dbo.price_schedules AS ps ON dps.price_schedule_id = ps.price_schedule_id INNER JOIN
        //     dbo.dmds AS dmd ON dps.dmd_id = dmd.dmd_id INNER JOIN
        //     (SELECT tb1.dmdcomb, tb1.dmdctr, tb1.dmdnost, tb1.brandname, tb2.gendesc, tb3.formdesc, tb4.rtedesc, tb5.stredesc, tb1.stockbal
        //     FROM hospital.dbo.hdruggrp AS tb6 INNER JOIN
        //     hospital.dbo.hdmhdr AS tb1 ON tb6.grpcode = tb1.grpcode INNER JOIN
        //     hospital.dbo.hgen AS tb2 ON tb2.gencode = tb6.gencode INNER JOIN
        //     hospital.dbo.hform AS tb3 ON tb1.formcode = tb3.formcode LEFT OUTER JOIN
        //     hospital.dbo.hroute AS tb4 ON tb1.rtecode = tb4.rtecode LEFT OUTER JOIN
        //     hospital.dbo.hstre AS tb5 ON tb5.strecode = tb1.strecode WHERE (tb6.grpstat = 'A') 
        //     AND (tb2.genstat = 'A') AND (tb1.dmdstat = 'A') AND (tb3.formstat = 'A') 
        //     AND (tb4.rtestat = 'A') AND (tb1.dmdstat = 'A') AND (tb2.genstat = 'A') 
        //     AND (tb5.strestat = 'A')) AS homis_dmd ON dmd.dmdcomb COLLATE DATABASE_DEFAULT = homis_dmd.dmdcomb 
        //     AND dmd.dmdctr = homis_dmd.dmdctr WHERE dps.supplier_id = $id ORDER BY homis_dmd.gendesc ASC");
        
        return response()->json($data);
    }

    public function store(){


    }

    public function update(){


    }

    public function destroy(){


    }
}
