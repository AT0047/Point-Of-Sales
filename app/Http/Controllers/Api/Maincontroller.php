<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Maincontroller extends Controller
{
    public function branches()
    {
        $data = DB::table('branches')->where('IsDeleted', '=', 0)->select('Branch_Id', 'BranchName')->get();
        return response($data);
    }
    public function UserBranches()
    {
        $data = DB::table('Users')
            ->where('users.Isdeleted', 0)
            ->join('userBranches', 'Users.Code', 'UserBranches.UserCode')
            ->where('userBranches.Isdeleted', '=', 0)
            ->where('userBranches.BranchId', '=', 1)
            ->select('users.Code', 'users.User_Name', 'users.UserPassword', 
            'users.DefaultMandoobCode', 'users.DefaultCashBooksCode', 
            'users.DefaultBankCode', 'users.DefaultStoreCode', 'userBranches.BranchId')
            ->get();
        return response($data);
    }
    public function Add_Unit_Details()
    {
        $data = DB::table('add_Unit_Details')->select('add_Unit_Code', 'U_Name', 'Code', 'Unit_N', 'Unit_V', 'Unit_Order')->
            where('IsDeleted', '=', 0)->where('Unit_N', '<>', '')->
            orderBy('U_Name')->get();
        return response($data);
    }

    public function ItemsGroup()
    {
        $data = DB::table('ItemsGroup')->select('Code', 'AccountName', 'ParentCode')->
            where('IsDeleted', '=', 0)->get();
        return response($data);
    }

    public function FItemD()
    {
        $data = DB::table('FItemD')->select(
            'Code',
            'Item_code',
            'Item_Name',
            'Type1_Code',
            'Sale_Price1',
            'Sale_price2',
            'Sale_price3',
            'Max_Discount',
            'Category1',
            'Category2',
            'Category3',
            'Add_Unit_Code',
            'ItemGroupCode',
            'DefaultItemTax',
            'TaxBreakCode',
            'DefaultTableTaxPercent'
        )
            ->where('IsDeleted', '=', 0)
            ->where('Store_Code', '=', '1-1')
            ->where('Hide_Item', '<>', 1)
            ->get();
        return response($data);
    }

    public function FItemD_BarCodes()
    {
        $data = DB::table('FItemD_BarCodes')->select('Item_code', 'Item_BarC', 'Add_Unit_Details_Code', 'Unit_Order')
            ->where('IsDeleted', '=', 0)
            ->get();
        return response($data);

    }
    public function Ne_Cust()
    {
        $data = DB::table('Ne_Cust')
            ->select('Code', 'CID', 'CName', 'Address1', 'Tel1', 'ItemPriceListName', 'TaxCardNo', 'Custnationality')
            ->where('IsDeleted', '=', 0)
            ->where('Hide', '!=', 1)
            ->where('CTY', '=', 0)
            ->get();
        return response($data);

    }

    public function ItemPriceList()
    {
        $data = DB::table('ItemPriceList')->select('ListName', 'Item_code', 'Unit_Price1', 'Unit_Price2', 'Unit_Price3')
            ->where('IsDeleted', '=', 0)
            ->get();
        return response($data);
    }

    public function SalesProposalItems()
    {
        $data = DB::table('SalesProposal')->join('SalesProposalItems', 'SalesProposal.Code', '=', 'SalesProposalItems.ProposalCode')
            ->join('ProposalRule', 'SalesProposal.RuleCode', '=', 'ProposalRule.Code')
            ->select(
                'SalesProposalItems.ProposalCode',
                'SalesProposal.ProposalStartDate',
                'SalesProposal.ProposalEndDate',
                DB::raw('(select top 1 FItemD.Item_code from FItemD where SalesProposalItems.FItemD_Code = FItemD.Code) as Item_code'),
                'SalesProposalItems.Add_Unit_Details_Code',
                'ProposalRule.ProposalQuantity',
                'ProposalRule.Quantity',
                'ProposalRule.DiscountPercent'
            )
            ->where('SalesProposalItems.ISRuled', 1)
            ->where('ProposalRule.Isdeleted', 0)
            ->where('SalesProposal.Isdeleted', 0)
            ->get();
        return response($data);
    }
}
/*->where('Isdeleted',0)
    ->join('UserBranches','Users.Code','UserBranches.UserCode')
    ->where('UserBranches.Isdeleted','=',0)
    ->where('UserBranches.BranchId','=',1)

    ->select('Users.Code, Users.User_Name, Users.UserPassword, Users.DefaultMandoobCode, Users.DefaultCashBooksCode, Users.DefaultBankCode, Users.DefaultStoreCode')
    ->get();*/
