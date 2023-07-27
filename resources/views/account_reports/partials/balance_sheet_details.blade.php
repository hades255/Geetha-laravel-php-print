<link media="print" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style type="text/css">
.amount-text {
    text-align: right;
}
</style>
<div class="row">
    <div class="col-md-6">
        <h3 class="text-left" style="color: #3577A3; border-bottom: 2px solid #3577A3">
            @lang('account.assets')</h3>
        <div class="clearfix"></div>
        <table class="table table-border table-striped">
            <thead>
                <th colspan="2">@lang('account.current_assets')</th>
            </thead>
            <tbody>
                @if($account_access)
                @foreach ($assets_accounts as $account_detail)
                <tr>
                    <td width="70%">{{$account_detail->name}}</td>
                    <td width="30%" class="amount-text">{{@num_format(($account_detail->balance))}}</></td>
                </tr>
                @endforeach
                @php
                $assets_accounts_main_balances_total = 0;
                @endphp
                @foreach ($assets_accounts_main_balances as $assets_accounts_main_balance_key =>
                $assets_accounts_main_balance)
                <tr>
                    <td>{{$assets_accounts_main_balance_key}}</td>
                    <td class="amount-text">{{@num_format(($assets_accounts_main_balance))}}</td>
                    @php
                    $assets_accounts_main_balances_total += $assets_accounts_main_balance;
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td>@lang('account.total_current_assets')</td>
                    <td class="amount-text">{{@num_format(($assets_accounts->sum('balance') +  $assets_accounts_main_balances_total))}}
                    </></td>
                </tr>
                @endif
            </tbody>

        </table>
        <div class="clearfix"></div>
        <table class="table table-border table-striped">
            <thead>
                <th colspan="2">@lang('account.property_plant_equipment')</th>
            </thead>
            <tbody>
                @if($account_access)
                @foreach ($fixed_assets_accounts as $account_detail)
                <tr>
                    <td width="70%">{{$account_detail->name}}</td>
                    <td width="30%" class="amount-text">{{@num_format(($account_detail->balance))}}</td>
               </tr>
                @endforeach
                @php
                $fixed_assets_accounts_main_balances_total = 0;
                @endphp
                @foreach ($fixed_assets_accounts_main_balances as $fixed_assets_accounts_main_balance_key =>
                $fixed_assets_accounts_main_balance)
                <tr>
                    <td width="70%">{{$fixed_assets_accounts_main_balance_key}}</td>
                    <td width="30%" class="amount-text">{{@num_format(($fixed_assets_accounts_main_balance))}}</td>
                    @php
                    $fixed_assets_accounts_main_balances_total += $fixed_assets_accounts_main_balance;
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td>@lang('account.property_plant_equipment_net')</td>
                    <td class="amount-text">{{@num_format(($fixed_assets_accounts->sum('balance') + $fixed_assets_accounts_main_balances_total))}}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <h3 class="text-left" style="color: #3577A3; border-bottom: 2px solid #3577A3">
            @lang('account.liabilities')</h3>
        <div class="clearfix"></div>
        <table class="table table-border table-striped">
            <thead>
                <th colspan="2">@lang('account.current_liabilities')</th>
            </thead>
            <tbody>
                @if($account_access)
                @foreach ($liabilities_accounts as $account_detail)
                <tr>
                   <td width="70%">{{$account_detail->name}}</td>
                    <td width="30%" class="amount-text">{{@num_format(($account_detail->balance))}}</td>
                </tr>
                @endforeach
                @php
                $liabilities_accounts_main_balances_total = 0;
                @endphp
                @foreach ($liabilities_accounts_main_balances as $liabilities_accounts_main_balance_key =>
                $liabilities_accounts_main_balance)
                <tr>
                    <td width="70%">{{$liabilities_accounts_main_balance_key}}</td>
                    <td width="30%" class="amount-text">{{@num_format(($liabilities_accounts_main_balance))}}</td>
                    @php
                    $liabilities_accounts_main_balances_total += $liabilities_accounts_main_balance;
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td>@lang('account.total_current_liabilities')</td>
                    <td class="amount-text">{{@num_format(($liabilities_accounts->sum('balance') + $liabilities_accounts_main_balances_total))}}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="clearfix"></div>
        <table class="table table-striped">
            <thead>
                <th colspan="2">@lang('account.long_term_liabilities')</th>
            </thead>
            <tbody>
                @if($account_access)
                @foreach ($lt_liabilities_accounts as $account_detail)
                <tr>
                <td width="70%">{{$account_detail->name}}</td>
                    <td width="30%" class="amount-text">{{@num_format(($account_detail->balance))}}</td>
                </tr>
                @endforeach
                @php
                $lt_liabilities_accounts_main_balances_total = 0;
                @endphp
                @foreach ($lt_liabilities_accounts_main_balances as $lt_liabilities_accounts_main_balance_key =>
                $lt_liabilities_accounts_main_balance)
                <tr>
                    <td>{{$lt_liabilities_accounts_main_balance_key}}</td>
                    <td class="amount-text">{{@num_format(($lt_liabilities_accounts_main_balance))}}</td>
                    @php
                    $lt_liabilities_accounts_main_balances_total += $lt_liabilities_accounts_main_balance;
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td>@lang('account.total_liabilities')</td>
                    <td class="amount-text">{{@num_format(($lt_liabilities_accounts->sum('balance') +  $lt_liabilities_accounts_main_balances_total))}}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3 class="text-left" style="color: #3577A3; border-bottom: 2px solid #3577A3">
            @lang('account.intangible_assets')</h3>
        <div class="clearfix"></div>
        <table class="table table-border table-striped">
            <tbody>
                @if($account_access)
                <tr>
                <td width="70%">@lang('account.good_will')</td>
                    <td width="30%" class="amount-text">000</td>
                </tr>
                <tr>
                    <td>@lang('account.trade_name')</td>
                    <td class="amount-text">000</td>
                </tr>
                <tr>
                    <td>@lang('account.total_intangible_assets')</td>
                    <td class="amount-text">000</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>@lang('account.total_assets')</b></td>
                    <td class="amount-text"><b>0000</b></td>
                </tr>
                @endif
            </tbody>

        </table>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-6">
        <h3 class="text-left" style="color: #3577A3; border-bottom: 2px solid #3577A3">
            @lang('account.stake_holder_equity')</h3>
        <div class="clearfix"></div>
        <table class="table table-border table-striped">
            <tbody>
                @if($account_access)
                <!--<tr>
                    <td width="70%">@lang('account.owner_contribution')</td>
                    <td width="30%" class="amount-text">{{@num_format($equity_accounts->sum('balance'))}}</td>
                </tr>-->
                @foreach ($equity_accounts_main_balances as $name=>$account_detail)
                <tr>
                    <td>{{$name}}</td>
                    <td class="amount-text">{{@num_format(($account_detail))}}</td>
                   
                </tr>
                @endforeach
                 @php
                     $total_equity = 0; 
                  @endphp
                @foreach ($equity_accounts as $equity)
                <tr>
                    <td>{{$equity->name}}</td>
                    <td class="amount-text">{{@num_format(($equity->balance))}}</td>
                     @php
                     $total_equity += $equity->balance;  
                     @endphp
                </tr>
                @endforeach
                <tr>
                    <td>@lang('account.total_stake_holder_equity')</td>
                    <td class="amount-text">{{@num_format($tl_equity_accounts_main_balances)}}</td>
                </tr>

                <tr>
                    <td>@lang('account.current_year_profit')</td>
                    <td class="amount-text">{{@num_format($net_profit)}}</td>
                </tr>
                <tr>
                    <td><b>@lang('account.total_liabilities_and_stake_holder_equity')</b></td>
                    <td class="amount-text"><b>{{@num_format(@$lt_liabilities_accounts->sum('balance') +  @$lt_liabilities_accounts_main_balances_total + @$liabilities_accounts->sum('balance') + 
                    @$net_profit + @$total_equity +
                    @$liabilities_accounts_main_balances_total + @$tl_equity_accounts_main_balances)}}</b></td>
                </tr>
                @endif
            </tbody>

        </table>
        <div class="clearfix"></div>

    </div>
</div>