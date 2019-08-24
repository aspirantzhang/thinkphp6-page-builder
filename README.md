ThinkPHP AntDesign Builder
---

A api page builder for AntDesign base on ThinkPHP 6

Under development, **DO NOT** apply to production environments !!!

The Package **MUST BE** used in conjunction with the **SPECIFIED** AntDesignPro package (Not published yet)

### Documentation
pageType: `list`, `create`.

### Installation

#### Step 1
```
composer require aspirantzhang/thinkphp-antdesign-builder
```
#### Step 2
Edit `app\provider.php`, insert below code
```
    'think\Paginator' => 'aspirantzhang\TPAntdBuilder\AntdPaginationProvider'
```
### Usage

Example code for build page elements.
```
use aspirantzhang\TPAntdBuilder\Builder;

class Admin extends Common
{
    // Page Builder
    public function buildPageIndex()
    {
        $builder = new Builder;

        $builder->page('admin-list', 'Admin List')
                ->pageType('list')
                ->table('tablename' ,'Table Title');

        $builder->searchBar()
                ->addText('username', 'Admin Name')
                ->placeholder('Enter Admin Name');
        $builder->searchBar()
                ->addSelect('status', 'Status')
                ->placeholder('Select Status')
                ->option([
                    'Disable'   =>  0,
                    'Enable'    =>  1,
                ]);


        $builder->toTable('tablename')
                ->addColumn('id', 'ID');
        $builder->toTable('tablename')
                ->addColumn('name', 'Admin Name')
                ->link('#/backend/admins/edit');
        $builder->toTable('tablename')
                ->addColumn('action', 'Operation')
                ->actionButton('edit', 'Edit', [
                    'onClick'   =>  [
                        'name'  =>  'openModal',
                        'url'   =>  'backend/admins/edit'
                    ]
                ])
                ->actionButton('delete', 'Delete', [
                    'onConfirm'   =>  [
                        'name'  =>  'changeStatus',
                        'url'   =>  'backend/admins/delete'
                    ]
                ]);

        return $builder->build();
    }
}
```
Use thinkphp build-in pagination method to get list data.
And then, mix them like this:
```
public function listApi($data)
{
    $list = $this->buildPageIndex();
    $dataSource = $this->where('status', 1)->paginate(10);
    $list['table']['dataSource'] = $dataSource['dataSource'];
    $list['table']['pagination'] = $dataSource['pagination'];
    return $list;
}
```
So we get the returned code below, they woud be called by AntDesignPro frontend.
```
{
    "page":
    {
        "name": "admin-list",
        "title": "Admin List",
        "pageType": "list"
    },
    "table":
    {
        "name": "tablename",
        "title": "Table Title",
        "column": [
        {
            "dataIndex": "id",
            "title": "ID"
        },
        {
            "dataIndex": "name",
            "title": "Admin Name",
            "a":
            {
                "href": "#\/backend\/admins\/edit",
                "target": "_self"
            }
        },
        {
            "dataIndex": "action",
            "title": "Operation",
            "action": [
            {
                "dataIndex": "edit",
                "title": "Edit",
                "onClick":
                {
                    "name": "openModal",
                    "url": "backend\/admins\/edit"
                }
            },
            {
                "dataIndex": "delete",
                "title": "Delete",
                "onConfirm":
                {
                    "name": "changeStatus",
                    "url": "backend\/admins\/delete"
                }
            }]
        }],
        "dataSource": [
        {
            "id": 69,
            "username": "admin2211",
            "display_name": "admin2211",
            "create_time": "2019-08-20 15:24:57",
            "update_time": "2019-08-20 15:24:57",
            "status": 1
        },
        {
            "id": 68,
            "username": "admin221",
            "display_name": "admin221",
            "create_time": "2019-08-20 15:21:04",
            "update_time": "2019-08-20 15:21:04",
            "status": 1
        },
        {
            "id": 67,
            "username": "admin1111",
            "display_name": "admin1111",
            "create_time": "2019-08-17 18:23:31",
            "update_time": "2019-08-17 18:23:31",
            "status": 1
        },
        {
            "id": 66,
            "username": "admin223",
            "display_name": "test2",
            "create_time": "2019-08-16 01:30:45",
            "update_time": "2019-08-16 01:30:45",
            "status": 1
        },
        {
            "id": 65,
            "username": "admin222",
            "display_name": "test2",
            "create_time": "2019-08-16 01:15:51",
            "update_time": "2019-08-16 01:15:51",
            "status": 1
        },
        {
            "id": 55,
            "username": "",
            "display_name": "test153",
            "create_time": "2019-08-16 00:29:49",
            "update_time": "2019-08-16 00:29:49",
            "status": 1
        },
        {
            "id": 54,
            "username": "test152",
            "display_name": "test152",
            "create_time": "2019-08-15 23:29:00",
            "update_time": "2019-08-15 23:29:00",
            "status": 1
        },
        {
            "id": 53,
            "username": "test151",
            "display_name": "test151",
            "create_time": "2019-08-15 23:12:47",
            "update_time": "2019-08-15 23:12:47",
            "status": 1
        },
        {
            "id": 52,
            "username": "fix0002",
            "display_name": "fix0002",
            "create_time": "2019-08-15 14:24:13",
            "update_time": "2019-08-15 14:24:13",
            "status": 1
        },
        {
            "id": 48,
            "username": "fix0001",
            "display_name": "fix0001",
            "create_time": "2019-08-15 13:53:21",
            "update_time": "2019-08-15 13:53:21",
            "status": 1
        }],
        "pagination":
        {
            "total": 37,
            "pageSize": 10,
            "current": 1
        }
    },
    "searchBar": [
    {
        "component": "input",
        "name": "username",
        "title": "Admin Name",
        "placeholder": "Enter Admin Name"
    },
    {
        "component": "select",
        "name": "status",
        "title": "Status",
        "placeholder": "Select Status",
        "option":
        {
            "Disable": 0,
            "Enable": 1
        }
    }]
}
```



