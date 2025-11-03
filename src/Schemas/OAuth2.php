<?php

namespace Hanafalah\SatuSehat\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2 as ContractsOAuth2;
use Hanafalah\SatuSehat\Contracts\Data\OAuth2Data;
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class OAuth2 extends SatuSehatLog implements ContractsOAuth2
{
    protected string $__entity = 'OAuth2';
    public $o_auth2_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'o_auth2',
            'tags'     => ['o_auth2', 'o_auth2-index'],
            'duration' => 24 * 60
        ]
    ];

    public function __construct(){
        parent::__construct();
    }

    public function useAccessToSatuSehat(): self{
        $this->accessToSatuSehat();
        return $this;
    }

    public function accessToSatuSehat(? string $token = null): bool{
        $token ??= SatuSehat::getAccessToken();
        $satu_sehat_log = $this->SatuSehatLogModel();
        if (isset($token)){
            $satu_sehat_log = $satu_sehat_log->where('props->response->access_token', $token)->first();
        }else{
            $satu_sehat_log = $satu_sehat_log->orderBy('created_at','desc')->where('name','OAuth2')->where('props->payload->client_id', SatuSehat::getClientId())->first();
        }
        if (!isset($satu_sehat_log)) {
            $this->directAuth();
            return true;
        }else{
            $this->o_auth2_model = $satu_sehat_log;            
            $this->initializeTokenize($satu_sehat_log->response['access_token']);
        }
        
        $expires_in = $satu_sehat_log->response['expires_in'] ?? 0;
        $created_at = $satu_sehat_log->created_at instanceof \Carbon\Carbon
            ? $satu_sehat_log->created_at
            : \Carbon\Carbon::parse($satu_sehat_log->created_at);

        $expired_at = $created_at->copy()->addSeconds(intval($expires_in));
        if (!$expired_at->isFuture()) {
            $this->directAuth();
            return true;
        }
        $this->findOrganization();
        return true;
    }

    private function initializeTokenize(string $token){
        SatuSehat::setAccessToken($token);
        SatuSehat::setHeader('Authorization','Bearer '.$token)
                ->initializeHttp();
    }

    private function directAuth(): self{
        request()->merge([
            'access_validation' => false
        ]);
        $this->schemaContract('OAuth2')->prepareStoreOauth2($this->requestDTO(config('app.contracts.OAuth2Data'),request()->all()));
        return $this;
    }

    private function findOrganization(){
        $organization_id = config('satu-sehat.organization_id');
        if (isset($organization_id)){
            $organization = $this->schemaContract('OrganizationSatuSehat')->prepareFindOrganizationSatuSehat(
                $this->requestDTO(config('app.contracts.OrganizationSatuSehatData'),[
                    'params' => [
                        'id' => $organization_id
                    ]
                ])
            );
            if (isset($organization) && $organization->count() > 0) {
                SatuSehat::setOrganization($organization->first());
            }else{
                throw new \Exception('Organization not found');
            }
        }
    }

    public function prepareStoreOauth2(OAuth2Data $o_auth2_dto): Model{
        if ($o_auth2_dto->access_validation) {
            $this->accessToSatuSehat();
        }else{
            $satu_sehat = SatuSehat::auth('accesstoken?grant_type='.$o_auth2_dto->grant_type,[
                'client_id'     => $o_auth2_dto->client_id,
                'client_secret' => $o_auth2_dto->client_secret
            ]);
            $this->o_auth2_model = $this->logSatuSehat($o_auth2_dto, SatuSehat::getResponse(),$satu_sehat,SatuSehat::getPayload(),[
                'grant_type' => $o_auth2_dto->grant_type
            ]);
            $token = $this->o_auth2_model->response['access_token'];
            $this->initializeTokenize($token);
            $this->findOrganization();
        }
        return $this->o_auth2_model;
    }

    protected function isOauth2Model(): bool{
        return $this->usingEntity()->getMorphClass() == 'OAuth2';
    }

    public function generalFind(? callable $callback = null): ?array{
        $this->accessToSatuSehat();
        return parent::generalFind($callback);
    }

    public function generalViewList(): array{
        $this->accessToSatuSehat();
        return parent::generalViewList();
    }

    public function generalStore(mixed $dto = null): array{
        if (!$this->isOauth2Model()) $this->accessToSatuSehat();
        return parent::generalStore($dto);
    }

    public function generalViewPaginate(?PaginateData $paginate_dto = null): array{
        $this->accessToSatuSehat();
        return parent::generalViewPaginate($paginate_dto);
    }

    public function oauth2(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}