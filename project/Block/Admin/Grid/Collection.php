<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Admin_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {

        $this->setCurrentCollection('personal');
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'title' => 'Admin Info',
            'block' => 'Admin_Grid_Collections_Personal',
            'header' => ['Id','First Name','Last Name','Email','Status','CreatedDate','updatedDate'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'personal'])
        ],'personal');
        $this->prepareCollectionContent();
    }
    public function prepareCollectionContent()
    {
        $admins = $this->getAdmins();
        if(!$admins){
            return null;
        }
        $array=[];
        foreach($admins as $admin)
        {
            $array1=[];
            $admin->stetus = $admin->getStatus($admin->stetus);
            foreach($admin->getData() as $key => $value)
            {
                $array1[]=$value;
            }
            array_push($array,$array1);
            
        }
        $this->setColumns($array);
        return $this;
    }


    public function getAdmins()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
        $adminModel = Ccc::getModel('Admin');   
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) FROM `admin`");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $admins = $adminModel->fetchAll("SELECT `id`,`firstName`,`lastName`,`email`,`stetus`,`createdDate`,`updatedDate` FROM `admin` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $this->setPagerModel($pagerModel);
        return $admins;

    }

}